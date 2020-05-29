<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface StockServiceInterface 
{
    /**
     * @deprecated since version 1.2
     * @param ItemInterface $item
     * @param float $quantity
     * @param PackagingInterface $packaging
     * @return ItemInterface
     */
    public function updateStock(ItemInterface $item, float $quantity = 0, PackagingInterface $packaging = null):ItemInterface;
    
    /**
     * since version 1.2
     * @param ItemInterface $item
     * @param float $quantity
     * @param PackagingInterface $packaging
     * @return ItemInterface
     */
    public function addStock(ItemInterface $item, float $quantity = 0, PackagingInterface $packaging = null):ItemInterface;
    
    /**
     * since version 1.2
     * @param ItemInterface $item
     * @param float $quantity
     * @param PackagingInterface $packaging
     * @return ItemInterface
     */
    public function getStock(ItemInterface $item, float $quantity = 0, PackagingInterface $packaging = null):ItemInterface;
}
