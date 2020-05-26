<?php

namespace Kematjaya\ItemPack\Service;

use Doctrine\ORM\EntityManagerInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class BaseItemService 
{
    protected $entityManager;
    
    function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    protected function doPersist($entity)
    {
        $uow = $this->entityManager->getUnitOfWork();
        $this->entityManager->persist($entity);
        $classMetadata = $this->entityManager->getClassMetadata(get_class($entity));
        $uow->computeChangeSet($classMetadata, $entity);
        
        return $entity;
    }
}
