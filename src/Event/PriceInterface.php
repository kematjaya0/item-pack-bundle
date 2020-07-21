<?php
namespace Kematjaya\ItemPack\Event;

use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceInterface 
{
    public function onChangePrincipalPrice(PriceLogInterface $priceLog):void;
}
