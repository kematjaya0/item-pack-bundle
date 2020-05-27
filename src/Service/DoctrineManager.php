<?php

namespace Kematjaya\ItemPack\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class DoctrineManager 
{
    protected $entityManager;
    
    function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    public function doPersist($entity):Collection
    {
        $uow = $this->entityManager->getUnitOfWork();
        $result = new ArrayCollection();
        if($entity instanceof Collection)
        {
            foreach($entity as $object)
            {
                $element = $this->persist($object);
                
                $result->add($element);
            }
        } else
        {
            $element = $this->persist($object);
            $result->add($element);
        }
        
        return $result;
    }
    
    private function persist($entity)
    {
        $this->entityManager->persist($entity);
        $classMetadata = $this->entityManager->getClassMetadata(get_class($entity));
        $uow->computeChangeSet($classMetadata, $entity);
        
        return $entity;
    }
}
