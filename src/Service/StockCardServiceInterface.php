<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\ClientStockCardInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\StockCardInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface StockCardServiceInterface 
{    
    public function insertStockCard(ItemInterface $item, ClientStockCardInterface $entity):StockCardInterface;
}
