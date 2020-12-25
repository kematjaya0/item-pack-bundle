<?php

namespace Kematjaya\ItemPack\Fixtures;

use Kematjaya\ItemPack\Lib\ItemCategory\Repo\ItemCategoryRepoInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemCategoryFixtures extends Fixture implements FixtureGroupInterface
{
    private $itemCategoryRepo;
    
    public function __construct(ItemCategoryRepoInterface $itemCategoryRepo) 
    {
        $this->itemCategoryRepo = $itemCategoryRepo;
    }
    
    public function load(ObjectManager $manager) 
    {
        for ($i = 0; $i < 20; $i++) {
            $object = $this->itemCategoryRepo->createItemCategory();
            $object->setName('test - ' . $i)
                ->setCode($i)
                ->setIsActive(true);
            $manager->persist($object);
        }
            
        $manager->flush();
    }
    
    public static function getGroups(): array 
    {
        return [
            'kmj-item'
        ];
    }

}
