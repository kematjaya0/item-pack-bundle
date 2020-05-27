<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceService implements PriceServiceInterface
{
    public function updatePrincipalPrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):Collection
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
        
        return new ArrayCollection([$itemPack, $item]);
    }
    
    public function updateSalePrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):Collection
    {
        if($item->getItemPackages()->isEmpty())
        {
            throw new \Exception('item package is empty');
        }
        
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
        
        return new ArrayCollection([$itemPack, $item]);
    }
}
