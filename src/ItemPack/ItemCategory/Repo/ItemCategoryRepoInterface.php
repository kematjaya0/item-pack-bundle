<?php

namespace Kematjaya\ItemPack\ItemCategory\Repo;

use Kematjaya\ItemPack\ItemCategory\Entity\ItemCategoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemCategoryRepoInterface extends ObjectRepository
{
    public function createItemCategory():ItemCategoryInterface;
}
