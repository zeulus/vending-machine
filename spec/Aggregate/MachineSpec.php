<?php

namespace spec\Zeulus\VendingMachine\Aggregate;

use Zeulus\VendingMachine\Aggregate\Machine;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MachineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Machine::class);
    }
}
