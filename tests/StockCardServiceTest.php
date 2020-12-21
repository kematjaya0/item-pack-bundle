<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Service\StockCardServiceInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\ClientStockCardInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockCardServiceTest extends KmjItemPackBundleTest
{
    public function testInstance():StockCardServiceInterface
    {
        $container = $this->getContainer();
        $this->assertTrue($container->has('kematjaya.stock_card_service'));
        $service = $container->get('kematjaya.stock_card_service');
        $this->assertInstanceOf(StockCardServiceInterface::class, $service);
        
        return $service;
    }
    
    /**
     * @depends testInstance
     */
    public function testInsert(StockCardServiceInterface $service)
    {
        $item = $this->buildObject();
        $client = $this->createConfiguredMock(ClientStockCardInterface::class, [
            'getClassId' => (string) rand(),
            'getTypeTransaction' => ClientStockCardInterface::TYPE_ADD,
            'getQuantity' => (float)10
        ]);
        $stockCard = $service->insertStockCard($item, $client);
        $this->assertEquals($item->getLastStock(), $stockCard->getTotal());
        $this->assertEquals($client->getQuantity(), $stockCard->getQuantity());
    }
}
