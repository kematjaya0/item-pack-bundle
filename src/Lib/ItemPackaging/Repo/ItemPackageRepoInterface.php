<?php

namespace Kematjaya\ItemPack\Lib\ItemPackaging\Repo;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemPackageRepoInterface 
{
    
    public function createPackage(ItemInterface $item):ItemPackageInterface;
    
    public function save(ItemPackageInterface $itemPackage): void;
    
    public function findSmallestUnitByItem(ItemInterface $item):?ItemPackageInterface;
    
}
