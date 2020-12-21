<?php

namespace Kematjaya\ItemPack\Exception;

use Exception;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class NotSufficientStockException extends Exception 
{
    public function __construct(float $available, float $expection, int $code = 0, \Throwable $previous = NULL)
    {
        $message = sprintf('not sufficine stock, available %s, expection %s', $available, $expection);
        return parent::__construct($message, $code, $previous);
    }
    
}