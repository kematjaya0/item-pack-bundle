<?php

namespace Kematjaya\ItemPack\Tests;

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
    
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
}
