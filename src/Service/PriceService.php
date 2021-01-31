<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\ItemPack\Service\PriceLogServiceInterface;
use Kematjaya\ItemPack\Event\PriceEventInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Kematjaya\ItemPack\Lib\Item\Repo\ItemRepoInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Repo\ItemPackageRepoInterface;
use Kematjaya\ItemPack\Lib\Price\Repo\PriceLogRepoInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogClientInterface;
use Kematjaya\ItemPack\Exception\PackageEmptyException;
use Kematjaya\ItemPack\Exception\SmallestPackageNotFoundException;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceService implements PriceServiceInterface, PriceLogServiceInterface
{
    use ServiceTrait;
    
    /**
     * 
     * @var ItemRepoInterface
     */
    private $itemRepo;
    
    /**
     * 
     * @var ItemPackageRepoInterface
     */
    private $itemPackageRepo;
    
    /**
     * 
     * @var PriceLogRepoInterface
     */
    private $priceLogRepo;
    
    /**
     * 
     * @var PriceEventInterface
     */
    private $priceEvent;
    
    public function __construct(ItemRepoInterface $itemRepo, ItemPackageRepoInterface $itemPackageRepo, PriceLogRepoInterface $priceLogRepo, PriceEventInterface $priceEvent) 
    {
        $this->itemRepo = $itemRepo;
        $this->itemPackageRepo = $itemPackageRepo;
        $this->priceLogRepo = $priceLogRepo;
        $this->priceEvent = $priceEvent;
    }
    
    public function updatePrincipalPrice(ItemInterface $item, PackagingInterface $packaging, float $price = 0):ItemInterface
    {
        $this->validate($item);
        
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        
        if (!$itemPack instanceof ItemPackageInterface) {
            throw new SmallestPackageNotFoundException($item);
        }
        
        $itemPack->setPrincipalPrice($price);
        if ($itemPack->isSmallestUnit()) {
            $item->setPrincipalPrice($price);
        }

        $this->itemPackageRepo->save($itemPack);
        $this->itemRepo->save($item);
        
        return $item;
    }
    
    public function updateSalePrice(ItemInterface $item, PackagingInterface $packaging, float $price = 0):ItemInterface
    {
        $this->validate($item);
        
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        if (!$itemPack instanceof ItemPackageInterface) {
            throw new SmallestPackageNotFoundException($item);
        }
        
        $itemPack->setSalePrice($price);
        if ($itemPack->isSmallestUnit()) {
            $item->setLastPrice($price);
        }

        $this->itemPackageRepo->save($itemPack);
        $this->itemRepo->save($item);
        
        return $item;
    }
    
    /**
     * Save Price if Principal Price != Old Principal Price
     * @param ItemInterface $item
     * @param float $price
     * @return PriceLogInterface|null
     */
    public function saveNewPrice(ItemInterface $item, float $price = 0):?PriceLogInterface
    {
        if (!$item instanceof PriceLogClientInterface) {
            return null;
        }
        
        if ($price == $item->getPrincipalPrice()) {
            return null;
        }
        
        $priceLog = $this->priceLogRepo->createPriceLog($item);
        $priceLog
                ->setCreatedAt(new \DateTime())
                ->setItem($item)
                ->setStatus(PriceLogInterface::STATUS_NEW)
                ->setPrincipalPrice($price)
                ->setSalePrice($price);
        if ($item->getActivePrincipalPrice()) {
            $priceLog->setPrincipalPriceOld($item->getActivePrincipalPrice());
        }
        
        if ($item->getActiveSalePrice()) {
            $priceLog->setSalePriceOld($item->getActiveSalePrice());
        }

        $this->priceLogRepo->save($priceLog);
        $this->priceEvent->onNewPrincipalPrice($priceLog);

        return $priceLog;
    }
    
    public function approvePrice(PriceLogInterface $priceLog):PriceLogClientInterface
    {
        $item = $priceLog->getItem();
        $item->setPrincipalPrice($priceLog->getPrincipalPrice());
        $item->setLastPrice($priceLog->getSalePrice());
        
        $priceLog->setStatus(PriceLogInterface::STATUS_APPROVED);
        
        $this->priceLogRepo->save($priceLog);
        
        $this->priceEvent->onApprovalPrincipalPrice($priceLog);

        $this->itemRepo->save($item);
        
        return $item;
    }
    
    public function rejectPrice(PriceLogInterface $priceLog):PriceLogInterface
    {
        $priceLog->setStatus(PriceLogInterface::STATUS_REJECTED);
        
        $this->priceLogRepo->save($priceLog);
        
        $this->priceEvent->onRejectPrincipalPrice($priceLog);
		
        return $priceLog;
    }
    
    protected function validate(ItemInterface $item):bool
    {
        if ($item->getItemPackages()->isEmpty()) {
            throw new PackageEmptyException(get_class($item));
        }
        
        return true;
    }
}
