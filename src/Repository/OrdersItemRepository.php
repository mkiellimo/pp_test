<?php

namespace App\Repository;

use App\Entity\OrdersItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrdersItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdersItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdersItem[]    findAll()
 * @method OrdersItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersItemRepository extends ServiceEntityRepository
{
    public function __construct (ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdersItem::class);
    }


}