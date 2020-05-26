<?php

namespace Kematjaya\ItemPack\Lib\Packaging\Entity;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PackagingInterface 
{
    public function getCode():?string;
    
    public function getName():?string;
    
    public function setCode(string $code):self;
    
    public function setName(string $name):self;
}
