<?php

namespace App\Service\Validator;


use App\Entity\Orders;
use App\Entity\OrdersItem;
use App\Service\Validator\Entity\ValidatorOrder;
use App\Service\Validator\Entity\ValidatorOrderItem;

class ValidateSearchOrders
{
    protected $validatorOrder;
    protected $validatorOrderItem;
    protected $em;

     public function __construct ($validate,$doctrine)
     {
         $this->validatorOrder = new ValidatorOrder($validate,$doctrine->getRepository(Orders::class));
         $this->validatorOrderItem = new ValidatorOrderItem($validate,$doctrine->getRepository(OrdersItem::class));
         $this->em=$doctrine->getManager();
     }

    public function getValidationOrder($order,$assoc=false){

        $listOrderItems = $order["orderItems"];
        unset($order["orderItems"]);
        $this->validatorOrder->setResponseArray($assoc);
        $entityOrder=$this->validatorOrder->validatorRequest($order);

        $entityOrders["order"] = $entityOrder;

        foreach ($listOrderItems as $item)
        {

            if (!is_array($entityOrder)){
                $this->validatorOrderItem->setOrderId($entityOrder->getId());
            }

            $this->validatorOrderItem->setResponseArray($assoc);
            $entityOrderItems = $this->validatorOrderItem->validatorRequest($item);

            if (!is_array($entityOrder)){
                $entityOrderItems->setOrders($entityOrder);
            }
            $entityOrders["items"][] =$entityOrderItems;

        }

        return $entityOrders;
    }


    public function saveOrder($entityOrder){

        $this->em->getConnection()->beginTransaction(); // suspend auto-commit
        try {
            $this->em->persist($entityOrder["order"]);
            foreach ($entityOrder["items"] as $item)
            {
                $this->em->persist($item);
            }
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }


}