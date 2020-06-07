<?php

namespace Kematjaya\ItemPack\Lib\Price\Entity;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceLogClientInterface 
{
    public function getActiveSalePrice(): ?float;

    public function setActiveSalePrice(float $price): self;
    
    public function getActivePrincipalPrice(): ?float;

    public function setActivePrincipalPrice(float $price): self;
}
