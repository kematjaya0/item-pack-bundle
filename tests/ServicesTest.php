<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Service\StockServiceInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ServicesTest extends KmjItemPackBundleTest 
{
    public function testStockService()
    {
        $container = $this->getContainer();
        $this->assertTrue($container->has('kematjaya.stock_service'));
        $service = $container->get('kematjaya.stock_service');
        $this->assertInstanceOf(StockServiceInterface, $service);
    }
}
