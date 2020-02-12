<?php
namespace App\Service\Validator;


class ValidatorException extends \Exception
{



    protected $_paramName;

    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        //TODO Email the technical team as I think this is a serious problem

    }

}