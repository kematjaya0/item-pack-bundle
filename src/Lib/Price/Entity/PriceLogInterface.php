<?php

namespace Kematjaya\ItemPack\Lib\Price\Entity;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceLogInterface 
{
    const STATUS_NEW = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 0;
    
    public function setItem(ItemInterface $item):self;
    
    public function getItem():?ItemInterface;
    
    public function getCreatedAt():?\DateTimeInterface;
    
    public function setCreatedAt(\DateTimeInterface $created_at):self;
    
    public function getPrincipalPriceOld():?float;
    
    public function setPrincipalPriceOld(float $price):self;
    
    public function getPrincipalPrice():?float;
    
    public function setPrincipalPrice(float $price):self;
    
    public function getSalePriceOld():?float;
    
    public function setSalePriceOld(float $price):self;
    
    public function getSalePrice():?float;
    
    public function setSalePrice(float $price):self;
    
    public function getStatus():?int;
    
    public function setStatus(int $status):self;
}
