<?php

namespace Kematjaya\ItemPack\Lib\Stock\Entity;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ClientStockCardInterface 
{
    public function getClassId():?string;
    
    public function getTypeTransaction():string;
    
    public function getQuantity():?float;
    
}
