<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Tests\BaseTest;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class BundleTest extends BaseTest 
{
    
    public function testInitBundle()
    {
        $container = $this->client->getContainer();
        $this->assertTrue($container->has('doctrine.orm.default_entity_manager'));
        $this->assertTrue($container->has('kematjaya.price_service'));
        $this->assertTrue($container->has('kematjaya.stock_service'));
    }
    
    public static function getKernelClass() 
    {
        return AppKernel::class;
    }
}
