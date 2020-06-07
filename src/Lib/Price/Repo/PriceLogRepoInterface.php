<?php

namespace Kematjaya\ItemPack\Lib\Price\Repo;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Collection;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PriceLogRepoInterface extends ObjectRepository 
{
    
    public function createPriceLog(ItemInterface $item):PriceLogInterface;
    
    public function save(PriceLogInterface $priceLog): void;
    
    /**
     * Get one price log by item where status is new
     * @param ItemInterface $item
     * @return PriceLogInterface|null
     */
    public function getNewPriceLogByItem(ItemInterface $item):?PriceLogInterface;
    
    /**
     * Get all price log where status is new
     * @return Collection|PriceLogInterface
     */
    public function getNewPriceLogs():Collection;
}
