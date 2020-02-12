<?php

namespace App\Service\Validator\Entity;
use App\Entity\OrdersItem;
use App\Service\Validator\AbstractValidator;
use App\Service\Validator\InterfaceValidator;


class ValidatorOrderItem extends AbstractValidator implements InterfaceValidator
{

    protected $idOrder;

    protected $mapping=[
        "item_sid"=>"barcode"
    ];

    protected function getEntity($data){
        $orderExist = $this->repository->findOneBy(['orders'=>$this->idOrder,'barcode' => $data['barcode']]);

        if ($orderExist){
            $this->entity=$orderExist;
            $this->setEntityFields();
        }

        return $this->entity;

    }

    protected function setEntityFields(){
        $this->setBarcode($this->data["barcode"]);
        $this->setPrice($this->data["price"]);
        $this->setCost($this->data["cost"]);
        $this->setTaxPerc($this->data["tax_perc"]);
        $this->setTaxAmt($this->data["tax_amt"]);
        $this->setQuantity($this->data["quantity"]);
        $this->setTrackingNumber($this->data["tracking_number"]);
        $this->setCanceled($this->data["canceled"]);
        $this->setShippedStatusSku($this->data["shipped_status_sku"]);

    }

    public function validatorRequest ($data)
    {
        $this->data=$data;
        return $this->getEntityValidate(OrdersItem::class);
    }

    public function setOrderId($id){
        $this->idOrder=$id;

    }



}