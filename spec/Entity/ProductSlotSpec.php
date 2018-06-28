<?php

namespace spec\Zeulus\VendingMachine\Entity;

use Zeulus\VendingMachine\Entity\Product;
use Zeulus\VendingMachine\Entity\ProductSlot;
use PhpSpec\ObjectBehavior;

class ProductSlotSpec extends ObjectBehavior
{
    const ID = 'A1';
    const CAPACITY = 10;

    function let()
    {
        $this->beConstructedWith(self::ID, self::CAPACITY);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductSlot::class);
    }

    function it_should_have_an_ID_assigned()
    {
        $this->getId()->shouldReturn(self::ID);
    }

    function it_should_have_products_count()
    {
        $this->count()->shouldReturn(0);
        $this->shouldHaveCount(0);
    }

    function it_should_be_able_to_insert_product_into_slot(Product $product)
    {
        $this->insertProduct($product);
        $this->shouldHaveCount(1);
        $this->insertProduct($product);
        $this->shouldHaveCount(2);
    }

    function it_should_be_possible_to_pick_an_item_from_the_slot(Product $product)
    {
        $this->insertProduct($product);
        $this->shouldHaveCount(1);
        $this->pickProduct()->shouldReturn($product);
        $this->shouldHaveCount(0);
    }

    function it_should_have_limit_of_products_in_the_slot()
    {
        $this->getCapacity()->shouldReturn(self::CAPACITY);

        for ($i=0; $i<self::CAPACITY; $i++) {
            $this->insertProduct(new Product("Mocny Full", 2.5));
        }

        $this->shouldHaveCount(self::CAPACITY);

        $this->shouldThrow('\DomainException')->duringInsertProduct(new Product("Mocny Full", 2.5));
    }

    function it_should_be_not_possible_to_pick_anything_from_empty_slot()
    {
        $this->shouldHaveCount(0);
        $this->pickProduct()->shouldReturn(null);
    }
}
