<?php

namespace App\Controller;

use App\Service\Helpers;
use App\Service\Validator\ValidateSearchOrders;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiController extends AbstractController
{
    const ORDER_ID="PP0400104913";
    private $responseApiGet='{
            "orderItems": [
            {
                "barcode": "4062345021658",
                "price": 24300.00,
                "cost": 24300.00,
                "tax_perc": 20,
                "tax_amt": 4050.00,
                "quantity": 1,
                "tracking_number": "1Z05V36Y7951053268",
                "canceled": "N",
                "shipped_status_sku": "not sent"
            },
            {
                "item_sid": "4062345067851",
                "price": 37800.00,
                "cost": 37800.00,
                "tax_perc": 20,
                "tax_amt": 63000.00,
                "quantity": 1,
                "tracking_number": "1Z05V36Y7951053268",
                "Canceled": "N",
                "shipped_status_sku": "not sent"
            }
            ],
                "orderId": "PP0400104913",
                "phone": "+79620230303",
                "shipping_status": "not sent",
                "shipping_price": 1000.00,
                "shipping_payment_status": "not paid",
                "payment_status": "not paid"
            }';




    /**
     * @Route("/api/order_search", methods="POST")
     * @param Request $request
     * @param ValidatorInterface $validate
     * @return JsonResponse
     */
    public function orderSearchAction(Request $request, ValidatorInterface $validate){


        $requestContent = $request->getContent();
        try{
        if (!Helpers::isJson($requestContent)){
            throw new \Exception("Bad Request");
        }
        $orders=json_decode($requestContent,true);
        $validatorOrders=new ValidateSearchOrders($validate, $this->getDoctrine());

            foreach ($orders as $order){
                $entityOrders[]=$validatorOrders->getValidationOrder($order);
            }

            foreach ($entityOrders as $entityOrder)
            {
                $validatorOrders->saveOrder($entityOrder);

            }
            return new JsonResponse(['message'=>'Insert orders ok '],Response::HTTP_ACCEPTED);

        }catch (Exception $exception){
            return new JsonResponse([
                                        'Controller'=>OrderController::class,
                                        'Action'=>'order_search',
                                        'Message'=>'Error post order search',
                                        'Errors'=>$exception->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Route("/api/get_order", methods="GET")
     * @param Request $request
     * @param ValidatorInterface $validate
     * @return JsonResponse
     */
    public function getOrderAction(Request $request, ValidatorInterface $validate){

        $requestContent = $this->responseApiGet;
        try{
            if (!Helpers::isJson($requestContent)){
                throw new \Exception("Bad Request");
            }
            $order=json_decode($requestContent,true);
            $orderSearch=$request->query->get('order_id');

            if ($orderSearch!==self::ORDER_ID)
            {

                return new JsonResponse(['data'=>["order"=>[],"items"=>[]]],Response::HTTP_ACCEPTED);
            }

            $validatorOrder=new ValidateSearchOrders($validate, $this->getDoctrine());
                $entityOrder=$validatorOrder->getValidationOrder($order,true);

                return new JsonResponse(['data'=>$entityOrder],Response::HTTP_ACCEPTED);

        }catch (Exception $exception){
            return new JsonResponse([
                                        'Controller'=>OrderController::class,
                                        'Action'=>'order_search',
                                        'Message'=>'Error post order search',
                                        'Errors'=>$exception->getMessage()],Response::HTTP_BAD_REQUEST);
        }




    }




}
