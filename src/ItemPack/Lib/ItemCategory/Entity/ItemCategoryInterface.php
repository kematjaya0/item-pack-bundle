<?php

namespace Kematjaya\ItemPack\Lib\ItemCategory\Entity;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemCategoryInterface 
{
    public function __toString():?string;
    
    public function setCode(string $code):self;
    
    public function getCode():?string;
    
    public function setName(string $name):self;
    
    public function getName():?string;
    
    public function setIsActive(bool $is_active):self;
    
    public function getIsActive():?bool;
}
