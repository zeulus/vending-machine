<?php

namespace Zeulus\VendingMachine\Aggregate;

use Traversable;
use Zeulus\VendingMachine\Entity\Product;

class ProductsCollection implements \IteratorAggregate
{
    /**
     * @var array Product[]
     */
    private $products = [];

    /**
     * @param Product $product
     */
    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    /**
     * @return \ArrayIterator|Traversable
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->products);
    }

    /**
     * @return array Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param string $productName
     *
     * @return bool
     */
    public function hasProduct(string $productName): bool
    {
        $foundProducts = array_filter($this->products,
            function (Product $product) use ($productName) {
                return ($product->getName() === $productName);
            });

        return (bool)count($foundProducts);
    }
}
