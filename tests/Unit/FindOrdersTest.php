<?php

namespace Tests\Unit;


use Domain\Services\Orders\OrderFindCriteria;
use Domain\Services\Orders\OrderService;
use PHPUnit\Framework\TestCase;

class FindOrdersTest extends TestCase
{
    /**
     * @test
     *
     * search orders by name filtered by type and status fact to display for marking an action
     */
    public function findOrdersByProductionType()
    {
        $filial = 1;
        $status = 10;
        $query = "09/10";

        $criteria = new OrderFindCriteria();
        $criteria->setFilial($filial);
        $criteria->setStatus($status);
        $criteria->setName($query);
        $criteria->addFields("actstatus");


        $service = new OrderService();
        $orderList = $service->filterOrders($criteria);

        self::assertNotCount(0, $orderList);
        foreach ($orderList as $order){
            self::assertEquals($filial, $order->filial);
            self::assertEquals($status, $order->status);
            self::assertStringContainsString($query, $order->name);

        }
    }

}
