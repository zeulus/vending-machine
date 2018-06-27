<?php

namespace spec\Zeulus\VendingMachine\Entity;

use Zeulus\VendingMachine\Entity\Product;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("Mocny Full", 2.5);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Product::class);
    }

    function it_should_have_basic_product_attributes()
    {
        $this->getName()->shouldReturn("Mocny Full");
        $this->getPrice()->shouldReturn(2.5);
    }
}
