<?php

namespace Kematjaya\ItemPack\Lib\Stock\Entity;

use Kematjaya\ItemPack\Lib\Stock\Entity\StockCardInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ClientStockCardInterface 
{
    const TYPE_GET = StockCardInterface::TYPE_GET;
    const TYPE_ADD = StockCardInterface::TYPE_ADD;
    
    public function getClassId():?string;
    
    public function getTypeTransaction():string;
    
    public function getQuantity():?float;
    
}
