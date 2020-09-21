<?php


namespace Domain\Services\Orders;



use App\Application\Entities\Order;
use Domain\Services\Orders\Dtos\OrderDto;

class OrderService
{

    /**
     * OrderService constructor.
     *
     */
    public function __construct()
    {

    }

    public function filterOrders(OrderFindCriteria $criteria): array
    {
        $return = [
            new OrderDto(new Order(1)),
            new OrderDto(new Order(2)),
            new OrderDto(new Order(3))
        ];

        return $return;
    }
}
