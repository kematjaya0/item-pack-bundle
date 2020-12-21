<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\ItemPack\Exception\PackageEmptyException;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceServiceTest extends KmjItemPackBundleTest 
{
    public function testInstance():PriceServiceInterface
    {
        $container = $this->getContainer();
        $this->assertTrue($container->has('kematjaya.price_service'));
        $service = $container->get('kematjaya.price_service');
            $this->assertInstanceOf(PriceServiceInterface::class, $service);
        
        return $service;
    }
    
    /**
     * @depends testInstance
     */
    public function testUpdatePrincipalPriceException(PriceServiceInterface $service)
    {
        $item = $this->buildObject();
        $packaging = $this->buildPackaging();
        
        $this->expectException(PackageEmptyException::class);
        $service->updatePrincipalPrice($item, $packaging, 1200);
    }
    
    /**
     * @depends testInstance
     */
    public function testUpdatePrincipalPriceSuccess(PriceServiceInterface $service)
    {
        $item = $this->buildObject();
        $item->addItemPackage($this->buildItemPackage($item));
        $packaging = $this->buildPackaging();
        
        $result = $service->updatePrincipalPrice($item, $packaging, 1500);
        $this->assertEquals(1500, $result->getPrincipalPrice());
    }
    
    /**
     * @depends testInstance
     */
    public function testUpdateSalePriceException(PriceServiceInterface $service)
    {
        $item = $this->buildObject();
        $packaging = $this->buildPackaging();
        
        $this->expectException(PackageEmptyException::class);
        $service->updateSalePrice($item, $packaging, 1200);
    }
    
    /**
     * @depends testInstance
     */
    public function testUpdateSalePriceSuccess(PriceServiceInterface $service)
    {
        $item = $this->buildObject();
        $item->addItemPackage($this->buildItemPackage($item));
        $packaging = $this->buildPackaging();
        
        $result = $service->updateSalePrice($item, $packaging, 1500);
        $this->assertEquals(1500, $result->getLastPrice());
    }
}
