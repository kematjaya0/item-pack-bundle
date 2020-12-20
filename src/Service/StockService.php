<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Lib\Item\Repo\ItemRepoInterface;
use Kematjaya\ItemPack\Service\StockServiceInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockService implements StockServiceInterface
{   
    /**
     * 
     * @var ItemRepoInterface
     */
    protected $itemRepo;
    
    use ServiceTrait;
    
    public function __construct(ItemRepoInterface $itemRepo) 
    {
        $this->itemRepo = $itemRepo;
    }
    
    /**
     * @deprecated since version 1.2
     * @param ItemInterface $item
     * @param float $quantity
     * @param PackagingInterface $packaging
     * @return ItemInterface
     */
    public function updateStock(ItemInterface $item, float $quantity = 0, PackagingInterface $packaging = null):ItemInterface
    {
        trigger_deprecation(self::class, "1.2", "test");
        $itemPack = $item->getItemPackages()->filter(function (ItemPackageInterface $itemPackage) use ($packaging) {
            if($packaging)
            {
                return $packaging->getCode() === $itemPackage->getPackaging()->getCode();
            }
            return $itemPackage->isSmallestUnit();
        })->first();
        
        if($itemPack instanceof ItemPackageInterface) {
            $quantity = $quantity * $itemPack->getQuantity();
        }
        
        return $item;
    }
    
    public function addStock(ItemInterface $item, float $quantity = 0, PackagingInterface $packaging = null):ItemInterface
    {
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        
        if($itemPack instanceof ItemPackageInterface) {
            $quantity = ($itemPack->isSmallestUnit()) ? $quantity : $quantity * $itemPack->getQuantity();
        }
        
        $lastStock = $item->getLastStock() + $quantity;
        $item->setLastStock($lastStock);
        
        $this->itemRepo->save($item);
        
        return $item;
    }
    
    public function getStock(ItemInterface $item, float $quantity = 0, PackagingInterface $packaging = null):ItemInterface
    {
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        
        if($itemPack instanceof ItemPackageInterface) {
            $quantity = ($itemPack->isSmallestUnit()) ? $quantity : $quantity * $itemPack->getQuantity();
        }
        
        $lastStock = $item->getLastStock() - $quantity;
        $item->setLastStock($lastStock);
        
        $this->itemRepo->save($item);
        
        return $item;
    }
}
