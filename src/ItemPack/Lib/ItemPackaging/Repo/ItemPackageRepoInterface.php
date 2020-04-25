<?php

namespace Kematjaya\ItemPack\Lib\ItemPackaging\Repo;

use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Doctrine\Common\Persistence\ObjectRepository;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemPackageRepoInterface extends ObjectRepository 
{
    
    public function createPackage():ItemPackageInterface;
    
}
