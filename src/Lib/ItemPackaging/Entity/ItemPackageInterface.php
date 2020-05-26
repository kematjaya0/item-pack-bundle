<?php

namespace Kematjaya\ItemPack\Lib\ItemPackaging\Entity;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemPackageInterface 
{
    
    public function getItem():ItemInterface;
    
    public function getPackaging():?PackagingInterface;
    
    public function setPrincipalPrice(float $price): self;
    
    public function getPrincipalPrice():?float;
    
    public function setSalePrice(float $price):self;
    
    public function getSalePrice():?float;
    
    public function setQuantity(float $quantity):self;
    
    public function getQuantity():?float;
    
    public function isSmallestUnit():bool;
    
}
