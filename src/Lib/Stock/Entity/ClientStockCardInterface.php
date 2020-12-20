<?php

namespace Kematjaya\ItemPack\Lib\Stock\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ClientStockCardInterface 
{
    
    public function getId():?UuidInterface;
    
    public function getTypeTransaction():string;
    
    public function getQuantity():?float;
    
}
