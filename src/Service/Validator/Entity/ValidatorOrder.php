<?php

namespace App\Service\Validator\Entity;

use App\Entity\Orders;
use App\Service\Validator\AbstractValidator;
use App\Service\Validator\InterfaceValidator;


class ValidatorOrder extends AbstractValidator implements InterfaceValidator
{

    protected function getEntity($data){
        $orderExist = $this->repository->findOneBy(['order_id' => $data['order_id']]);
        if ($orderExist){
            $this->entity=$orderExist;
            $this->setEntityFields();
        }

        return $this->entity;

    }

    protected function setEntityFields(){

        $this->setPhone($this->data["phone"]);
        $this->setShippingStatus($this->data["shipping_status"]);
        $this->setShippingPrice($this->data["shipping_price"]);
        $this->setPaymentStatus($this->data["shipping_payment_status"]);
        $this->setPaymentStatus($this->data["payment_status"]);
    }

    public function validatorRequest ($data)
    {
        $this->data=$data;
        return $this->getEntityValidate(Orders::class);

    }
}