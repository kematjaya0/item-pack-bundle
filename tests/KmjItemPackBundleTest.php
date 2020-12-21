<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Tests\Model\Item;
use Kematjaya\ItemPack\Tests\Model\Packaging;
use Kematjaya\ItemPack\Tests\Model\ItemPackage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class KmjItemPackBundleTest extends WebTestCase
{
    protected function getContainer(): ContainerInterface
    {
        $client = parent::createClient();
        return $client->getContainer();
    }
    
    protected function buildObject(): Item
    {
        $item = (new Item())
                ->setPrincipalPrice(1000)
                ->setCode('test')
                ->setName('Test')
                ->setLastPrice(1200)
                ->setLastStock(0)
                ->setUseBarcode(false);
        
        return $item;
    }
    
    protected function buildItemPackage(Item $item):ItemPackage
    {
        $packaging = (new Packaging())->setCode('pcs')->setName('PCS');
        
        return (new ItemPackage())
                ->setItem($item)
                ->setPackaging($packaging)
                ->setQuantity(1)
                ->setPrincipalPrice($item->getPrincipalPrice())
                ->setSalePrice($item->getLastPrice());
    }
    
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
}
