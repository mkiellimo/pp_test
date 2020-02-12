<?php

namespace App\Service\Validator;

use App\Service\Helpers;
use App\Service\Validator\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractValidator
{

    private $validator;
    protected $data;
    protected $mapping=[];

    protected $entity=null;
    protected $repository=null;
    protected $responseArray=false;

    public function __construct ($validator,$repository)
    {
        $this->repository=$repository;
        $this->setValidator($validator);


    }

    public function setResponseArray($param){
        $this->responseArray=$param;
    }

    public function getEntityValidate($entity){
        Helpers::camelToSnakeArray($this->data);
        $this->data=array_change_key_case($this->data, CASE_LOWER);
        $this->applayMappingFields();
        $this->entity= Helpers::deserializeObjJson(json_encode($this->data),$entity);
        $this->validateRequest($this->entity);
        if (!$this->responseArray){
            return $this->getEntity($this->data);
        }else{
            return $this->data;
        }
    }

    protected function updateFieldsEntity($name, $value) {
        if (array_key_exists($name,$this->data)){
            $this->entity->$name($value);
        }
    }

    public function __call($method, $args) {
        $strNameField=ucfirst(str_replace("set","",$method));
        $strNameField=Helpers::camelToSnake($strNameField);

        if (array_key_exists($strNameField,$this->data))
        {
            $this->entity->$method($args[0]);
        }
    }

    protected function setValidator (ValidatorInterface $validate)
    {
        $this->validator = $validate;
    }

    protected function validateRequest($data){

        $errors= $this->validator->validate($data);
        $errorsResponse= [];

        foreach ($errors as $error){
            $errorsResponse[]= [
                'field' => $error->getPropertyPath(),
                'message'=> $error->getMessage()
            ];
        }

        if (!empty($errorsResponse)){
            throw new ValidatorException(json_encode($errorsResponse));
        }

    }

    abstract protected function getEntity($data);
    abstract protected function setEntityFields();


    private function applayMappingFields(){
        foreach ($this->mapping as $alias  => $nameFields ){
            if (array_key_exists($alias,$this->data)){
                $this->data[$nameFields]=$this->data[$alias];
                unset($this->data[$alias]);
            }
        }
    }



}