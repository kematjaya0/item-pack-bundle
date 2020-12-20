<?php
namespace Kematjaya\ItemPack\Event;

use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceInterface 
{
    public function onNewPrincipalPrice(PriceLogInterface $priceLog):void;
	
    public function onApprovalPrincipalPrice(PriceLogInterface $priceLog):void;
	
    public function onRejectPrincipalPrice(PriceLogInterface $priceLog):void;
}
