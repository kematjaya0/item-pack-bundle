<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Exception\PackageEmptyException;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
trait ServiceTrait 
{
    protected function getItemPackByPackagingOrSmallestUnit(ItemInterface $item, PackagingInterface $packaging = null):?ItemPackageInterface
    {
        if ($item->getItemPackages()->isEmpty()) {
            throw new PackageEmptyException(get_class($item));
        }
        
        return $item->getItemPackages()->filter(function (ItemPackageInterface $itemPackage) use ($packaging) {
            if ($packaging) {
                return $packaging->getCode() === $itemPackage->getPackaging()->getCode();
            }
            
            return $itemPackage->isSmallestUnit();
        })->first();
    }
}
