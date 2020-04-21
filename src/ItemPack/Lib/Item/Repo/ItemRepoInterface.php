<?php

namespace Kematjaya\ItemPack\Lib\Item\Repo;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Doctrine\Common\Persistence\ObjectRepository;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemRepoInterface extends ObjectRepository 
{
    
    public function createItem():ItemInterface;
}
