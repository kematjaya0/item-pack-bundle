<?php

namespace Kematjaya\ItemPack\Lib\Packaging\Repo;

use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PackagingRepoInterface 
{
    public function createPackaging():PackagingInterface;
    
    public function save(PackagingInterface $package): void;
}
