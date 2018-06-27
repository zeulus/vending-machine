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
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @return \ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->products);
    }

    /**
     * @return array Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param $productName
     *
     * @return int
     */
    public function hasProduct($productName)
    {
        $foundProducts = array_filter($this->products,
            function (Product $product) use ($productName) {
                return ($product->getName() === $productName);
            });

        return (bool)count($foundProducts);
    }
}
