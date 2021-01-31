<?php

namespace Kematjaya\ItemPack\Lib\ItemCategory\Repo;

use Kematjaya\ItemPack\Lib\ItemCategory\Entity\ItemCategoryInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemCategoryRepoInterface
{
    public function createItemCategory():ItemCategoryInterface;
    
    public function save(ItemCategoryInterface $itemPackage): void;
    
}
