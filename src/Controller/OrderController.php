<?php

namespace App\Controller;


use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class OrderController extends AbstractController
{
    /**
     * @Route("/orders/show", name="show_orders")
     * @param OrdersItemRepository $orderItemsRepo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(OrdersRepository $orderRepo )
    {
        return $this->render('order/index.html.twig', [
                'orders'=>$orderRepo->findOneByIdJoinedToItems()
        ]);
    }



}
