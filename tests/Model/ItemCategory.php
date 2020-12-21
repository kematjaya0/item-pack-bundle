<?php

namespace Kematjaya\ItemPack\Tests\Model;

use Kematjaya\ItemPack\Lib\ItemCategory\Entity\ItemCategoryInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemCategory implements ItemCategoryInterface
{
    /**
     * 
     * @var string
     */
    private $code;
    
    /**
     * 
     * @var bool
     */
    private $is_active;
    
    /**
     * 
     * @var string
     */
    private $name;
    
    public function __toString(): ?string 
    {
        return $this->getName();
    }

    public function getCode(): ?string 
    {
        return $this->code;
    }

    public function getIsActive(): ?bool 
    {
        return $this->is_active;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    public function setCode(string $code): ItemCategoryInterface 
    {
        $this->code = $code;
        
        return $this;
    }

    public function setIsActive(bool $is_active): ItemCategoryInterface 
    {
        $this->is_active = $is_active;
        
        return $this;
    }

    public function setName(string $name): ItemCategoryInterface 
    {
        $this->name = $name;
        
        return $this;
    }

}
