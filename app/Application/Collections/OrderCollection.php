<?php


namespace App\Application\Collections;


use App\Application\Entities\Order;

class OrderCollection implements \Iterator
{
    /** @var Order[] */
    private $content = [];
    private $index = 0;

    /**
     * OrderCollection constructor.
     */
    public function __construct()
    {
    }

    public function add(Order $order): void
    {
        $this->content[] = $order;
    }

    public function current(): Order
    {
        return $this->content[$this->index];
    }


    public function next(): void
    {
        $this->index++;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return isset($this->content[$this->index]);
    }

    public function rewind()
    {
        $this->index = 0;
    }
}
