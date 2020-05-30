<?php

namespace Kematjaya\ItemPack\Lib\Packaging\Repo;

use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Doctrine\Common\Persistence\ObjectRepository;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PackagingRepoInterface extends ObjectRepository 
{
    public function createPackaging():PackagingInterface;
    
    public function save(PackagingInterface $package): void;
}
