<?php

namespace Kematjaya\ItemPack\Tests\Model;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\ItemCategory\Entity\ItemCategoryInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class Item implements ItemInterface
{
    /**
     * 
     * @var ItemCategoryInterface
     */
    private $category;
    
    /**
     * 
     * @var string
     */
    private $code;
    
    /**
     * 
     * @var float
     */
    private $last_price;
    
    /**
     * 
     * @var float
     */
    private $last_stock;
    
    /**
     * 
     * @var string
     */
    private $name;
    
    /**
     * 
     * @var float
     */
    private $principal_price;
    
    /**
     * 
     * @var bool
     */
    private $use_barcode;
    
    public function getCategory(): ?ItemCategoryInterface 
    {
        return $this->category;
    }

    public function getCode(): ?string 
    {
        return $this->code;
    }

    public function getItemPackages(): Collection 
    {
        return new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getLastPrice(): ?float 
    {
        return $this->last_price;
    }

    public function getLastStock(): ?float 
    {
        return $this->last_stock;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    public function getPrincipalPrice(): ?float 
    {
        return $this->principal_price;
    }

    public function getUseBarcode(): ?bool 
    {
        return $this->use_barcode;
    }

    public function setCategory(?ItemCategoryInterface $category): ItemInterface 
    {
        $this->category = $category;
        
        return $this;
    }

    public function setCode(string $code): ItemInterface 
    {
        $this->code = $code;
        
        return $this;
    }

    public function setLastPrice(float $last_price): ItemInterface 
    {
        $this->last_price = $last_price;
        
        return $this;
    }
    
    public function setLastStock(float $last_stock): ItemInterface 
    {
        $this->last_stock = $last_stock;
        
        return $this;
    }

    public function setName(string $name): ItemInterface 
    {
        $this->name = $name;
        
        return $this;
    }

    public function setPrincipalPrice(float $principal_price): ItemInterface 
    {
        $this->principal_price = $principal_price;
        
        return $this;
    }

    public function setUseBarcode(bool $use_barcode): ItemInterface 
    {
        $this->use_barcode = $use_barcode;
        
        return $this;
    }

}
