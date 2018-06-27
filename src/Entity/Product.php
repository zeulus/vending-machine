<?php

namespace Zeulus\VendingMachine\Entity;

class Product
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * Product constructor.
     *
     * @param string $name
     * @param float  $price
     */
    public function __construct($name, $price)
    {
        $this->name  = $name;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}
