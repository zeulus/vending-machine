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
}
