<?php


namespace App\Application\Entities;


class Order
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $status;
    /**
     * @var string
     */
    private $name;
    /** @var int */
    private $filial;

    /**
     * Order constructor.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
        $this->status = 10;
        $this->name = "09/10";
        $this->filial = 1;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFilial()
    {
        return $this->filial;
    }
}
