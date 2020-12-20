<?php

namespace Kematjaya\ItemPack\Lib\Item\Entity;

use Doctrine\Common\Collections\Collection;
use Kematjaya\ItemPack\Lib\ItemCategory\Entity\ItemCategoryInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemInterface 
{
    public function getCode(): ?string;

    public function setCode(string $code): self;

    public function getName(): ?string;

    public function setName(string $name): self;

    public function getCategory(): ?ItemCategoryInterface;

    public function setCategory(?ItemCategoryInterface $category): self;

    public function getUseBarcode(): ?bool;

    public function setUseBarcode(bool $use_barcode): self;

    public function getLastStock(): ?float;

    public function setLastStock(float $last_stock): self;
    
    public function getLastPrice(): ?float;

    public function setLastPrice(float $last_price): self;
    
    public function getItemPackages(): Collection;
    
    public function getPrincipalPrice(): ?float;

    public function setPrincipalPrice(float $principal_price): self;
}
