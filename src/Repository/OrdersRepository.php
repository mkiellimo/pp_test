<?php

namespace App\Repository;

use App\Entity\Orders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    public function findOneByIdJoinedToItems($orderId = null)
    {

        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT o,oi
        FROM App\Entity\Orders o
        INNER JOIN o.ordersItems oi');

        try {
            return $query->getArrayResult();

        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }


    }


    public function calcTotAmount()
    {

        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT SUM(oi.price)
                    FROM App\Entity\Orders o
                    INNER JOIN o.ordersItems oi 
                    WHERE o.payment_status='paid'
                  "
            );

        try {
            return $query->getOneOrNullResult()[1];
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }


    }



}
