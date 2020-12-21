<?php

namespace Kematjaya\ItemPack\Lib\Stock\Repo;

use Kematjaya\ItemPack\Lib\Stock\Entity\StockCardInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface StockCardRepoInterface
{
    public function createStockCard():StockCardInterface;
    
    public function save(StockCardInterface $package): void;
}
