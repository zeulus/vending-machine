<?php

namespace spec\Zeulus\VendingMachine\Aggregate;

use Zeulus\VendingMachine\Aggregate\ProductsCollection;
use PhpSpec\ObjectBehavior;
use Zeulus\VendingMachine\Entity\Product;

class ProductsCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductsCollection::class);
        $this->shouldImplement(\IteratorAggregate::class);
    }

    function it_should_be_able_to_add_a_product(Product $product)
    {
        $this->addProduct($product);
    }

    function it_should_be_able_to_retrieve_added_products()
    {
        $products = [];
        for ($i = 1; $i < 5; $i++) {
            $product = new Product("Product {$i}", $i);
            $this->addProduct($product);
            $products[] = $product;
        }

        $this->getProducts()->shouldReturn($products);
    }

    function it_should_check_if_product_is_available_when_I_select_it()
    {
        $mocnyFull = new Product("Mocny Full", 2.5);
        $this->addProduct($mocnyFull);

        $this->hasProduct("Mocny Full")->shouldReturn(true);
        $this->hasProduct("Baton Proteinowy")->shouldReturn(false);
    }
}
