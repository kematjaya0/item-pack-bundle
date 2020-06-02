<?php

namespace Kematjaya\ItemPack\Lib\Stock\Entity;


/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ClientStockCardInterface 
{
    
    public function getId():?int;
    
    public function getTypeTransaction():string;
    
    public function getQuantity():?float;
    
}
