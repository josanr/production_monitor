<?php

namespace Tests\Collections;

use App\Application\Collections\OrderCollection;
use App\Application\Entities\Order;
use PHPUnit\Framework\TestCase;

class OrderCollectionTest extends TestCase
{

    /** @test  */
    public function addItems_to_collection()
    {
        $collection = new OrderCollection();

        $order1 = new Order(1);
        $order2 = new Order(1);
        $order3 = new Order(1);

        $collection->add($order1);
        $collection->add($order2);
        $collection->add($order3);

        $count = 0;
        foreach ($collection as $item){
            self::assertInstanceOf(Order::class, $item);
            $count++;
        }

        self::assertEquals(3, $count);
    }
}
