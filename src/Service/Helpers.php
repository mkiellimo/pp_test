<?php
namespace App\Service;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Helpers
{
    public static function deserializeObjJson($data,$entity){
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer=new Serializer($normalizers, $encoders);
        return $serializer->deserialize($data,$entity, 'json');

    }

    public static function camelToSnake ( $input )
    {
        if ( preg_match ( '/[A-Z]/', $input ) === 0 ) { return $input; }
        $pattern = '/([a-z])([A-Z])/';
        $r = strtolower ( preg_replace_callback ( $pattern, function ($a) {
            return $a[1] . "_" . strtolower ( $a[2] );
        }, $input ) );

        return $r;
    }


    public static function camelToSnakeArray(&$list){

        foreach ($list as $index => $value)
        {
            $strSnake = self::camelToSnake($index);

            if ($strSnake!==$index)
            {
                $list[$strSnake] = $list[$index];
                unset($list[$index]);
            }
        }

    }


    public static function isJson($string){
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);

    }
}