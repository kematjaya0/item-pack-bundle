<?php

namespace Kematjaya\ItemPack\Lib\Stock\Entity;


/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ClientStockCardInterface 
{
    
    public function getId():?\Ramsey\Uuid\UuidInterface;
    
    public function getTypeTransaction():string;
    
    public function getQuantity():?float;
    
}
