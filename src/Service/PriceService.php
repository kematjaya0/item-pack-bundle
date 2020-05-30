<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Kematjaya\ItemPack\Lib\Item\Repo\ItemRepoInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Repo\ItemPackageRepoInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceService implements PriceServiceInterface
{
    use Service;
    
    protected $itemRepo, $itemPackageRepo;
    
    public function __construct(ItemRepoInterface $itemRepo, ItemPackageRepoInterface $itemPackageRepo) 
    {
        $this->itemRepo = $itemRepo;
        $this->itemPackageRepo = $itemPackageRepo;
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
