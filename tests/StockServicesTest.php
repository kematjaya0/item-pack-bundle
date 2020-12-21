<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Exception\NotSufficientStockException;
use Kematjaya\ItemPack\Exception\PackageEmptyException;
use Kematjaya\ItemPack\Service\StockServiceInterface;
use Kematjaya\ItemPack\Tests\Model\Item;
use Kematjaya\ItemPack\Tests\Model\Packaging;
use Kematjaya\ItemPack\Tests\Model\ItemPackage;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockServicesTest extends KmjItemPackBundleTest 
{
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
    
    public function testInstance():StockServiceInterface
    {
        $container = $this->getContainer();
        $this->assertTrue($container->has('kematjaya.stock_service'));
        $service = $container->get('kematjaya.stock_service');
        $this->assertInstanceOf(StockServiceInterface::class, $service);
        
        return $service;
    }
    
    /**
     * @depends testInstance
     */
    public function testStockServiceException(StockServiceInterface $service)
    {
        $this->expectException(PackageEmptyException::class);
        $item = $this->buildObject();
        $service->addStock($item, 10);
    }
    
    /**
     * @depends testInstance
     */
    public function testAddStockServiceSuccess(StockServiceInterface $service)
    {
        $item = $this->buildObject();
        $itemPackage = $this->buildItemPackage($item);
        $item->addItemPackage($itemPackage);
        
        $expect1 = $item->getLastStock() + 10;
        $service->addStock($item, 10);
        $this->assertEquals($item->getLastStock(), $expect1);
        
        $expect2 = $item->getLastStock() + 10;
        $service->addStock($item, 10);
        $this->assertEquals($item->getLastStock(), $expect2);
    }
    
    /**
     * @depends testInstance
     */
    public function testGetStockServiceException(StockServiceInterface $service)
    {
        $item = $this->buildObject();
        $itemPackage = $this->buildItemPackage($item);
        $item->addItemPackage($itemPackage);
        
        $this->expectException(NotSufficientStockException::class);
        $service->getStock($item, 10);
    }
    
    /**
     * @depends testInstance
     */
    public function testGetStockServiceSuccess(StockServiceInterface $service)
    {
        $item = $this->buildObject();
        $itemPackage = $this->buildItemPackage($item);
        $item->addItemPackage($itemPackage);
        
        $service->addStock($item, 10);
        
        $expect = $item->getLastStock() - 5;
        $service->getStock($item, 5);
        $this->assertEquals($item->getLastStock(), $expect);
    }
}
