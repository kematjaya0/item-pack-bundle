<?php

namespace Kematjaya\ItemPack\FormSubscriber;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Repo\ItemPackageRepoInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemPackageFormSubscriber implements EventSubscriberInterface 
{
    
    /**
     * 
     * @var ItemPackageRepoInterface
     */
    private $itemPackageRepo;
    
    public function __construct(ItemPackageRepoInterface $itemPackageRepo) 
    {
        $this->itemPackageRepo = $itemPackageRepo;
    }
    
    public static function getSubscribedEvents(): array 
    {
        return [
            FormEvents::POST_SUBMIT => 'postSubmit'
        ];
    }

    public function postSubmit(FormEvent $event)
    {
        $data = $event->getData();
        if(!$data instanceof ItemPackageInterface) {
            return;
        }   
        
        $form = $event->getForm();
        if($data->isSmallestUnit()) {
            $smallestUnit = $this->itemPackageRepo->findSmallestUnitByItem($data->getItem());
            if($smallestUnit and $smallestUnit->getId() !== $data->getId()) {
                $form->addError(new FormError('kemasan terkecil tidak boleh lebih dari 1'));
                return false;
            }

            $data->setQuantity(1);
        }else {
            $data->setIsSmallestUnit(false);
        }

        if($data->getPrincipalPrice()) {
            $data->setPrincipalPrice(0);
        }
        
        if($data->getSalePrice()) {
            $data->setSalePrice(0);
        }

        $event->setData($data);
    }
}
