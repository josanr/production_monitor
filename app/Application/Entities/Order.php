<?php


namespace App\Application\Entities;


class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * Order constructor.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
