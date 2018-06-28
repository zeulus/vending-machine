<?php
declare(strict_types=1);

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
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
