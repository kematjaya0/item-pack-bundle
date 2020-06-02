<?php

namespace Kematjaya\ItemPack\Service;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Stock\Repo\StockCardRepoInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\StockCardInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\ClientStockCardInterface;
use Kematjaya\ItemPack\Service\StockCardServiceInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockCardService implements StockCardServiceInterface
{
    
    protected $stockCardRepo;
    
    use Service;
    
    public function __construct(StockCardRepoInterface $stockCardRepo) 
    {
        $this->stockCardRepo = $stockCardRepo;
    }
    
    public function insertStockCard(ItemInterface $item, ClientStockCardInterface $entity = null):StockCardInterface
    {
        switch($entity->getTypeTransaction())
        {
            case StockCardInterface::TYPE_ADD:
                break;
            case StockCardInterface::TYPE_GET:
                break;
            default:
                throw new \Exception('invalid type transaction : '. $entity->getTypeTransaction());
                break;
        }
        $stockCard = $this->stockCardRepo->createStockCard();
        $stockCard->setCreatedAt(new \DateTime())
                ->setItem($item)
                ->setQuantity($entity->getQuantity())
                ->setType($entity->getTypeTransaction())
                ->setTotal($item->getLastStock())
                ->setClassName(get_class($entity))
                ->setClassId($entity->getId());
        
        $this->stockCardRepo->save($stockCard);
        
        return $stockCard;
    }
}
