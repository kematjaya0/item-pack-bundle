<?php

namespace Kematjaya\ItemPack\Lib\Stock\Repo;

use Kematjaya\ItemPack\Lib\Stock\Entity\StockCardInterface;
use Doctrine\Common\Persistence\ObjectRepository;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface StockCardRepoInterface extends ObjectRepository
{
    public function createStockCard():StockCardInterface;
    
    public function save(StockCardInterface $package): void;
}
