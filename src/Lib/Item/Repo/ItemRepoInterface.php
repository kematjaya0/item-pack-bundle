<?php

namespace Kematjaya\ItemPack\Lib\Item\Repo;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemRepoInterface 
{
    
    public function createItem():ItemInterface;
    
    public function save(ItemInterface $item):void;
}
