<?php

namespace Kematjaya\ItemPack\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class KmjItemPackExtension extends Extension 
{
    public function load(array $configs, ContainerBuilder $container) 
    {
        $loader = new XmlFileLoader($container,
            new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.xml');
    }
}
