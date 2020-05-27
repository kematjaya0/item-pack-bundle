<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Doctrine\Common\Collections\Collection;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceServiceInterface 
{
    public function updatePrincipalPrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):Collection;
    
    public function updateSalePrice(ItemInterface $item, float $price = 0, PackagingInterface $packaging = null):Collection;
}
