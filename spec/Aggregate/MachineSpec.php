<?php

namespace spec\Zeulus\VendingMachine\Aggregate;

use Zeulus\VendingMachine\Aggregate\Machine;
use PhpSpec\ObjectBehavior;
use Zeulus\VendingMachine\Aggregate\ProductsCollection;
use Zeulus\VendingMachine\Entity\Coin;
use Zeulus\VendingMachine\Entity\Product;

class MachineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Machine::class);
    }

    function it_should_be_in_normal_mode_when_initialized()
    {
        $this->getMode()->shouldReturn(Machine::MODE_NORMAL);
    }

    function it_should_allow_you_to_insert_coins(Coin $coin)
    {
        $this->insertCoin($coin);
    }

    function it_should_reject_an_item_which_is_not_a_coin()
    {
        $this->shouldThrow('\TypeError')->duringInsertCoin('aaaaa');
    }

    function it_should_return_total_value_of_inserted_coins()
    {
        $sum = 0;
        for ($i = 1; $i < 3; $i++) {
            $this->insertCoin(new Coin($i));
            $sum += $i;
        }

        $this->getCredits()->shouldReturn($sum);
    }

    function it_should_allow_to_change_operational_mode_between_service_and_normal()
    {
        $this->changeMode(Machine::MODE_NORMAL);
        $this->getMode()->shouldReturn(Machine::MODE_NORMAL);
        $this->changeMode(Machine::MODE_SERVICE);
        $this->getMode()->shouldReturn(Machine::MODE_SERVICE);
        $this->shouldThrow('\InvalidArgumentException')->duringChangeMode(33);
    }

    function it_should_be_possible_to_return_all_coins_that_were_inserted()
    {
        $coins = [];
        for ($i = 1; $i <= 3; $i++) {
            $coin = new Coin($i);
            $this->insertCoin($coin);
            $coins[] = $coin;
        }

        $this->returnCoins()->shouldReturn($coins);
        $this->getCredits()->shouldReturn(0);
    }

    function it_should_be_possible_to_add_merchandise_to_the_machine(ProductsCollection $productsCollection) {
        $this->changeMode(Machine::MODE_SERVICE);
        $this->setAvailableProducts($productsCollection);
        $this->getAvailableProducts()->shouldReturn($productsCollection);
    }

    function it_shoould_allow_adding_products_only_in_service_mode(ProductsCollection $productsCollection) {
        $this->changeMode(Machine::MODE_NORMAL);
        $this->shouldThrow(\DomainException::class)
             ->duringSetAvailableProducts($productsCollection);
    }
}
