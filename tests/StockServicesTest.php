<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Exception\NotSufficientStockException;
use Kematjaya\ItemPack\Exception\PackageEmptyException;
use Kematjaya\ItemPack\Service\StockServiceInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockServicesTest extends KmjItemPackBundleTest 
{
  
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
