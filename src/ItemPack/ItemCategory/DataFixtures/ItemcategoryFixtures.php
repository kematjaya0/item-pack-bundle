<?php

namespace App\Library\ItemCategory\DataFixtures;

use App\Library\ItemCategory\Repo\ItemCategoryRepoInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemcategoryFixtures extends Fixture
{
    private $itemCategoryRepo;
    
    public function __construct(ItemCategoryRepoInterface $itemCategoryRepo) 
    {
        $this->itemCategoryRepo = $itemCategoryRepo;
    }
    
    public function load(ObjectManager $manager) 
    {
        for ($i = 0; $i < 20; $i++)
        {
            $object = $this->itemCategoryRepo->createItemCategory();
            $object->setName('test - ' . $i)
                ->setCode($i)
                ->setIsActive(true);
            $manager->persist($object);
        }
            
        $manager->flush();
    }

}
