<?php

namespace Kematjaya\ItemPack\Tests\Model;

use Kematjaya\ItemPack\Lib\Stock\Entity\StockCardInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockCard implements StockCardInterface
{
    /**
     * 
     * @var string
     */
    private $class_id;
    
    /**
     * 
     * @var string
     */
    private $class_name;
    
    /**
     * 
     * @var \DateTimeInterface
     */
    private $created_at;
    
    /**
     * 
     * @var ItemInterface
     */
    private $item;
    
    /**
     * 
     * @var float
     */
    private $quantity;
    
    /**
     * 
     * @var float
     */
    private $total;
    
    /**
     * 
     * @var string
     */
    private $type;
    
    public function getClassId(): string 
    {
        return $this->class_id;
    }

    public function getClassName(): string 
    {
        return $this->class_name;
    }

    public function getCreatedAt(): \DateTimeInterface 
    {
        return $this->created_at;
    }

    public function getItem(): ItemInterface 
    {
        return $this->item;
    }

    public function getQuantity(): float 
    {
        return $this->quantity;
    }

    public function getTotal(): float 
    {
        return $this->total;
    }

    public function getType(): string 
    {
        return $this->type;
    }

    public function setClassId(string $class_id): StockCardInterface 
    {
        $this->class_id = $class_id;
        
        return $this;
    }

    public function setClassName(string $class_name): StockCardInterface 
    {
        $this->class_name = $class_name;
        
        return $this;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): StockCardInterface 
    {
        $this->created_at = $created_at;
        
        return $this;
    }
    
    public function setItem(ItemInterface $item): StockCardInterface 
    {
        $this->item = $item;
        
        return $this;
    }

    public function setQuantity(float $quantity): StockCardInterface 
    {
        $this->quantity = $quantity;
        
        return $this;
    }

    public function setTotal(float $total): StockCardInterface 
    {
        $this->total = $total;
        
        return $this;
    }

    public function setType(string $type): StockCardInterface 
    {
        $this->type = $type;
        
        return $this;
    }

}
