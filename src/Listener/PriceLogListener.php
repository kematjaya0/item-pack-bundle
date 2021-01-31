<?php

namespace Kematjaya\ItemPack\Listener;

use Doctrine\ORM\Event\OnFlushEventArgs;
use Kematjaya\ItemPack\Service\PriceLogServiceInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceLogListener 
{
    
    /**
     * 
     * @var PriceLogServiceInterface
     */
    private $priceLogService;
    
    public function __construct(PriceLogServiceInterface $priceLogService) 
    {
        $this->priceLogService = $priceLogService;
    }
    
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();
        
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if (!$entity instanceof PriceLogInterface) {
                continue;
            }
            
            $this->updateprice($entity);
        }
        
        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if (!$entity instanceof PriceLogInterface) {
                continue;
            }
            
            $this->updatePrice($entity);
        }
        
        foreach($uow->getScheduledEntityDeletions() as $entity) {
            if (!$entity instanceof PriceLogInterface) {
                continue;
            }
            
            $this->updatePrice($entity);
        }
    }
    
    private function updatePrice(PriceLogInterface $entity)
    {
        switch ($entity->getStatus())
        {
            case PriceLogInterface::STATUS_APPROVED:
                $this->priceLogService->approvePrice($entity);
                break;
            case PriceLogInterface::STATUS_REJECTED:
                $this->priceLogService->rejectPrice($entity);
                break;
            default:
                break;
        }
        
    }
}
