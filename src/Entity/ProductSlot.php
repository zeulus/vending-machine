<?php

namespace Zeulus\VendingMachine\Entity;

class ProductSlot implements \Countable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var array Product[]
     */
    private $products = [];

    /**
     * @var int
     */
    private $capacity;

    /**
     * ProductSlot constructor.
     *
     * @param string $id
     * @param int    $capacity
     */
    public function __construct(string $id, int $capacity)
    {
        $this->id = $id;
        $this->capacity = $capacity;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->products);
    }

    /**
     * @param Product $product
     * @throws \DomainException
     */
    public function insertProduct(Product $product): void
    {
        if (count($this->products) < $this->capacity) {
            $this->products[] = $product;
        }
        else
        {
            throw new \DomainException("Limit of {$this->capacity} items has been reached, cannot add new item");
        }
    }

    /**
     * @return Product
     */
    public function pickProduct(): ?Product
    {
        return $this->count() > 0 ? array_pop($this->products) : null;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }
}
