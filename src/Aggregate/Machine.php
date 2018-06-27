<?php

namespace Zeulus\VendingMachine\Aggregate;

use Zeulus\VendingMachine\Entity\Coin;

class Machine
{
	/**
	 * @var array Coin[]
	 */
	private $insertedCoins = [];

	/**
	 * @param Coin $coin
	 */
    public function insertCoin(Coin $coin)
    {
		$this->insertedCoins[] = $coin;
    }

	/**
	 * @return int
	 */
    public function getCredits()
    {
        return array_reduce(
        	$this->insertedCoins,
	        function ($sum, Coin $item) {
        	    return $sum = $sum += $item->getValue();
            },
	        0
        );
    }
}
