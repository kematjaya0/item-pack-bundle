<?php

namespace Kematjaya\ItemPack\Item\Repo;

use Kematjaya\ItemPack\Item\Entity\ItemInterface;
use Doctrine\Common\Persistence\ObjectRepository;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemRepoInterface extends ObjectRepository 
{
    
    public function createItem():ItemInterface;
}
