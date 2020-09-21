<?php


namespace Domain\Services\Orders\Dtos;


use App\Application\Entities\Order;

class OrderDto
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var int
     */
    public $status;
    /**
     * @var int
     */
    public $filial;

    /**
     * OrderDto constructor.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->name = $order->getName();
        $this->status = $order->getStatus();
        $this->filial = $order->getFilial();
    }
}
