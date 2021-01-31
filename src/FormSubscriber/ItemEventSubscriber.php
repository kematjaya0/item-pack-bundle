<?php

namespace Kematjaya\ItemPack\FormSubscriber;

use Kematjaya\ItemPack\Lib\Item\Repo\ItemRepoInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemEventSubscriber implements EventSubscriberInterface 
{
    /**
     * 
     * @var ItemRepoInterface
     */
    private $itemRepo;
    
    public function __construct(ItemRepoInterface $itemRepo) 
    {
        $this->itemRepo = $itemRepo;
    }
    
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
        if (!$item instanceof ItemInterface) {
            return;
        }
        
        $event
            ->getForm()
                ->add('last_stock', null, [
                    'label' => 'last_stock',
                    'attr' => ['readonly' => true]
                ]);
        
        $event->setData($item);
    }
    
    public function postSubmit(FormEvent $event)
    {
        $item = $event->getData();
        if (!$item instanceof ItemInterface) {
            return;
        }
        
        $item->setCode(trim($item->getCode()));
        $item->setName(trim($item->getName()));
        if (null === $item->getLastStock()) {
            $item->setLastStock(0);
        }

        if (null === $item->getUseBarcode()) {
            $item->setUseBarcode(false);
        }
        
        $identicItem = $this->itemRepo->findIdenticItem($item);
        if ($identicItem) {
            $event->getForm()->get('code')->addError(new FormError(sprintf("item with code %s already exist", $item->getCode())));
        }
        
        $event->setData($item);
    }
}
