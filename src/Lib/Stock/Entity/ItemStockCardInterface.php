<?php

namespace Kematjaya\ItemPack\Lib\Stock\Entity;

use Doctrine\Common\Collections\Collection;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ItemStockCardInterface 
{
    public function getStockCards():Collection;
    
    public function stockCardSupport():bool;
}
