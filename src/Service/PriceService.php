<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\ItemPack\Service\PriceLogServiceInterface;
use Kematjaya\ItemPack\Event\PriceInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Kematjaya\ItemPack\Lib\Item\Repo\ItemRepoInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Repo\ItemPackageRepoInterface;
use Kematjaya\ItemPack\Lib\Price\Repo\PriceLogRepoInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogClientInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceService implements PriceServiceInterface, PriceLogServiceInterface
{
    use Service;
    
    protected $itemRepo, $itemPackageRepo, $priceLogRepo, $priceEvent;
    
    public function __construct(
        ItemRepoInterface $itemRepo, 
        ItemPackageRepoInterface $itemPackageRepo,
        PriceLogRepoInterface $priceLogRepo, 
        PriceInterface $priceEvent) 
    {
        $this->itemRepo = $itemRepo;
        $this->itemPackageRepo = $itemPackageRepo;
        $this->priceLogRepo = $priceLogRepo;
        $this->priceEvent = $priceEvent;
    }
    
    public function updatePrincipalPrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):ItemInterface
    {
        if($item->getItemPackages()->isEmpty())
        {
            throw new \Exception('item package is empty');
        }
        
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        
        if($itemPack instanceof ItemPackageInterface)
        {
            $itemPack->setPrincipalPrice($price);
            if($itemPack->isSmallestUnit())
            {
                $item->setPrincipalPrice($price);
            }
            
            $this->itemPackageRepo->save($itemPack);
        }
        
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
        if($item instanceof PriceLogClientInterface)
        {
            if($price !== $item->getPrincipalPrice())
            {
                $priceLog = $this->priceLogRepo->createPriceLog($item);
                $priceLog->setStatus(PriceLogInterface::STATUS_NEW)
                        ->setPrincipalPrice($price)
                        ->setSalePrice($price);
                if($item->getActivePrincipalPrice())
                {
                    $priceLog->setPrincipalPriceOld($item->getActivePrincipalPrice());
                }
                if($item->getActiveSalePrice())
                {
                    $priceLog->setSalePriceOld($item->getActiveSalePrice());
                }

                $this->priceLogRepo->save($priceLog);
                $this->priceEvent->onNewPrincipalPrice($priceLog);
                
                return $priceLog;
            }
        }
            
        
        return null;
    }
    
    public function approvePrice(PriceLogInterface $priceLog):PriceLogClientInterface
    {
        $item = $priceLog->getItem();
        $item->setPrincipalPrice($priceLog->getPrincipalPrice());
        $item->setLastPrice($priceLog->getSalePrice());
        
        $this->priceLogRepo->save($priceLog);
        
        $this->priceEvent->onApprovalPrincipalPrice($priceLog);

        $this->itemRepo->save($item);
        
        return $item;
    }
    
    public function rejectPrice(PriceLogInterface $priceLog):PriceLogInterface
    {
        $this->priceLogRepo->save($priceLog);
        
        $this->priceEvent->onRejectPrincipalPrice($priceLog);
		
        return $priceLog;
    }
    
    public function updateSalePrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):ItemInterface
    {
        if($item->getItemPackages()->isEmpty())
        {
            throw new \Exception('item package is empty');
        }
        
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        
        if($itemPack instanceof ItemPackageInterface)
        {
            $itemPack->setSalePrice($price);
            if($itemPack->isSmallestUnit())
            {
                $item->setLastPrice($price);
            }
            
            $this->itemPackageRepo->save($itemPack);
        }
        
        $this->itemRepo->save($item);
        
        return $item;
    }
}
