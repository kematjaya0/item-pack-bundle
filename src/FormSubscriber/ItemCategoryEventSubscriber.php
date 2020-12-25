<?php

namespace Kematjaya\ItemPack\FormSubscriber;

use Kematjaya\ItemPack\Lib\ItemCategory\Entity\ItemCategoryInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemCategoryEventSubscriber implements EventSubscriberInterface 
{
    
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT => 'postSubmit'
        ];
    }
    
    public function preSetData(FormEvent $event)
    {
        $itemCategory = $event->getData();
        if(!$itemCategory instanceof ItemCategoryInterface) {
            return;
        }
        
        if(!$itemCategory->getId()) {
            $itemCategory->setIsActive(true);
        }

        $event->setData($itemCategory);
    }
    
    public function postSubmit(FormEvent $event)
    {
        $itemCategory = $event->getData();
        if(!$itemCategory instanceof ItemCategoryInterface) {
            return;
        }
        
        $itemCategory->setCode(trim($itemCategory->getCode()));
        $itemCategory->setName(trim($itemCategory->getName()));

        $event->setData($itemCategory);
    }
}
