<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogClientInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceLogServiceInterface 
{
    public function saveNewPrice(ItemInterface $item, float $price = 0):?PriceLogInterface;
    
    public function approvePrice(PriceLogInterface $priceLog):PriceLogClientInterface;
    
    public function rejectPrice(PriceLogInterface $priceLog):PriceLogInterface;
}
