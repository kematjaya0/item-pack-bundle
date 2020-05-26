<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Service\BaseItemService;
use Kematjaya\ItemPack\Service\StockServiceInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockService extends BaseItemService implements StockServiceInterface
{   
    public function updateStock(ItemInterface $item, float $quantity = 0, PackagingInterface $packaging = null):ItemInterface
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
            $quantity = $quantity * $itemPack->getQuantity();
        }
        
        $item->setLastStock($quantity);
        
        return $this->doPersist($item);
    }
}
