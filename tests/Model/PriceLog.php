<?php

namespace Kematjaya\ItemPack\Tests\Model;

use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceLog implements PriceLogInterface
{
    private $created_at;
    private $item;
    private $principalPrice;
    private $principalPriceOld;
    private $salePrice;
    private $salePriceOld;
    private $status;
    
    public function getCreatedAt(): ?\DateTimeInterface 
    {
        return $this->created_at;
    }

    public function getItem(): ?ItemInterface 
    {
        return $this->item;
    }

    public function getPrincipalPrice(): ?float 
    {
        return $this->principalPrice;
    }

    public function getPrincipalPriceOld(): ?float 
    {
        return $this->principalPriceOld;
    }

    public function getSalePrice(): ?float 
    {
        return $this->salePrice;
    }

    public function getSalePriceOld(): ?float 
    {
        return $this->salePriceOld;
    }

    public function getStatus(): ?int 
    {
        return $this->status;
    }

    
    public function isApproved(): bool 
    {
        return self::STATUS_APPROVED === $this->status;
    }

    public function isNew(): bool 
    {
        return self::STATUS_NEW === $this->status;
    }

    public function isRejected(): bool 
    {
        return self::STATUS_REJECTED === $this->status;
    }
    
    public function setCreatedAt(\DateTimeInterface $created_at): PriceLogInterface 
    {
        $this->created_at = $created_at;
        
        return $this;
    }

    public function setItem(ItemInterface $item): PriceLogInterface 
    {
        $this->item = $item;
        
        return $this;
    }

    public function setPrincipalPrice(float $price): PriceLogInterface 
    {
        $this->principalPrice = $price;
        
        return $this;
    }

    public function setPrincipalPriceOld(float $price): PriceLogInterface 
    {
        $this->principalPriceOld = $price;
        
        return $this;
    }

    public function setSalePrice(float $price): PriceLogInterface 
    {
        $this->salePrice = $price;
        
        return $this;
    }

    public function setSalePriceOld(float $price): PriceLogInterface 
    {
        $this->salePriceOld = $price;
        
        return $this;
    }

    public function setStatus(int $status): PriceLogInterface 
    {
        $this->status = $status;
        
        return $this;
    }

}
