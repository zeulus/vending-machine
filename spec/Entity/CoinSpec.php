<?php

namespace spec\Zeulus\VendingMachine\Entity;

use Zeulus\VendingMachine\Entity\Coin;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CoinSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Coin::class);
    }

    function it_should_have_a_value()
    {
		$this->getValue()->shouldReturn(1);
    }
}
