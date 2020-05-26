<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Service\BaseItemService;
use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceService extends BaseItemService implements PriceServiceInterface
{
    
    public function updatePrincipalPrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):ItemInterface
    {
        $itemPack = $item->getItemPackages()->filter(function (ItemPackageInterface $itemPackage) use ($packaging) {
            if($packaging)
            {
                return $packaging->getCode() === $itemPackage->getPackaging()->getCode();
            }
            return $itemPackage->isSmallestUnit();
        })->first();
        
        
        if($itemPack instanceof ItemPackageInterface)
        {
            $itemPack->setPrincipalPrice($price);
            if($itemPack->isSmallestUnit())
            {
                $item->setPrincipalPrice($price);
            }
        }
        $this->doPersist($itemPack);
        return $this->doPersist($item);
    }
    
    public function updateSalePrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):ItemInterface
    {
        $itemPack = $item->getItemPackages()->filter(function (ItemPackageInterface $itemPackage) use ($packaging) {
            if($packaging)
            {
                return $packaging->getCode() === $itemPackage->getPackaging()->getCode();
            }
            return $itemPackage->isSmallestUnit();
        })->first();
        
        
        if($itemPack instanceof ItemPackageInterface)
        {
            $itemPack->setSalePrice($price);
            if($itemPack->isSmallestUnit())
            {
                $item->setLastPrice($price);
            }
        }
        $this->doPersist($itemPack);
        return $this->doPersist($item);
    }
}
