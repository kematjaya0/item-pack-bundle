<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceServiceInterface 
{
    public function updatePrincipalPrice(ItemInterface $item, PackagingInterface $packaging, float $price = 0):ItemInterface;
    
    public function updateSalePrice(ItemInterface $item, PackagingInterface $packaging, float $price = 0):ItemInterface;
    
}
