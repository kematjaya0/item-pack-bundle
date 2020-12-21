<?php

namespace Kematjaya\ItemPack\Exception;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Exception;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SmallestPackageNotFoundException extends Exception 
{
    public function __construct(ItemInterface $item, int $code = 0, \Throwable $previous = NULL)
    {
        $message = sprintf('please select smallest package for item code: %s', $item->getCode());
        return parent::__construct($message, $code, $previous);
    }
}
