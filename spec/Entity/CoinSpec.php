<?php

namespace spec\Zeulus\VendingMachine\Entity;

use Zeulus\VendingMachine\Entity\Coin;
use PhpSpec\ObjectBehavior;

class CoinSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(1);
        $this->shouldHaveType(Coin::class);
    }

    function it_should_return_its_value()
    {
        $myValue = 5;
        $this->beConstructedWith($myValue);
        $this->getValue()->shouldReturn($myValue);
    }
}
