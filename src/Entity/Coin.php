<?php

namespace Zeulus\VendingMachine\Entity;

class Coin
{
	/**
	 * @var int
	 */
	private $value;

	/**
	 * Coin constructor.
	 *
	 * @param int $value
	 */
    public function __construct($value)
    {
        $this->value = $value;
    }

	/**
	 * @return int
	 */
    public function getValue()
    {
        return $this->value;
    }
}
