<?php

namespace Kematjaya\ItemPack\Lib\ItemPackaging\Entity;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemPackageInterface 
{
    
    public function setName(string $name): self;
    
    public function getName():?string;
    
    public function setSymbol(string $symbol):self;
    
    public function getSymbol():string;
    
    public function isSmallestUnit():bool;
    
    public function setQuantity(float $quantity):self;
    
    public function getQuantity():?float;
    
    public function getItem():ItemInterface;
    
    public function setPrincipalPrice(float $price): self;
    
    public function getPrincipalPrice():?float;
    
    public function setSalePrice(float $price):self;
    
    public function getSalePrice():?float;
}
