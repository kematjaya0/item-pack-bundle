<?php

namespace Kematjaya\ItemPack\Lib\Item\EventSubscriber;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemEventSubscriber implements EventSubscriberInterface 
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
        $item = $event->getData();
        if($item instanceof ItemInterface)
        {
            $event->getForm()->add('last_stock', null, [
                'label' => 'last_stock',
                'attr' => ['class' => 'form-control', 'readonly' => true]
            ]);
            if(!$item->getId())
            {
                $item->setUseBarcode(false);
            }
            
            $event->setData($item);
        }
    }
    
    public function postSubmit(FormEvent $event)
    {
        $item = $event->getData();
        if($item instanceof ItemInterface)
        {
            $item->setCode(trim($item->getCode()));
            $item->setName(trim($item->getName()));
            if(is_null($item->getLastStock()))
            {
                $item->setLastStock(0);
            }
            
            if($item->getUseBarcode() == false)
            {
                $item->setUseBarcode(false);
            }
            
            $event->setData($item);
        }
    }
}
