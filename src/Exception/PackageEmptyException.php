<?php

namespace Kematjaya\ItemPack\Exception;

use Exception;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PackageEmptyException extends Exception 
{
    public function __construct(string $class, int $code = 0, \Throwable $previous = NULL)
    {
        $message = sprintf('packaging for class %s is empty', $class);
        return parent::__construct($message, $code, $previous);
    }
    
}
