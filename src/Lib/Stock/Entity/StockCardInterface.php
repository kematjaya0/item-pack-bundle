<?php

namespace Kematjaya\ItemPack\Lib\Stock\Entity;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface StockCardInterface 
{
    const TYPE_GET = 'GET';
    const TYPE_ADD = 'ADD';
    
    public function setItem(ItemInterface $item):self;
    
    public function getItem():ItemInterface;
    
    public function getCreatedAt():\DateTimeInterface;
    
    public function setCreatedAt(\DateTimeInterface $created_at):self;
    
    public function getClassName():string;
    
    public function setClassName(string $class_name):self;
    
    public function getClassId():int;
    
    public function setClassId(int $class_id):self;
    
    public function getQuantity(): float;
    
    public function setQuantity(float $quantity): self;
    
    public function getType():string;
    
    public function setType(string $type):self;
    
    public function getTotal():float;
    
    public function setTotal(float $total):self;
}
