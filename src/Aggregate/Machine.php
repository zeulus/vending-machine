<?php

namespace Zeulus\VendingMachine\Aggregate;

use Zeulus\VendingMachine\Entity\Coin;

class Machine
{
    /**
     * Machine operates normally, buying is possible
     */
    const MODE_NORMAL = 1;

    /**
     * Machine is in service mode - we can add and remove products without paying
     */
    const MODE_SERVICE = 2;

    /**
     * @var array Coin[]
     */
    private $insertedCoins = [];

    /**
     * @var int
     */
    private $mode;

    /**
     * @var ProductsCollection
     */
    private $availableProducts;

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

    /**
     * @param int $mode
     */
    public function changeMode($mode)
    {
        if ( ! in_array($mode, [self::MODE_NORMAL, self::MODE_SERVICE])) {
            throw new \InvalidArgumentException("Machine cannot operate in such mode.");
        }
        $this->mode = $mode;
    }

    /**
     * @return int
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @return array Coin[]
     */
    public function returnCoins()
    {
        $allCoins = $this->insertedCoins;
        $this->insertedCoins = [];

        return $allCoins;
    }

    /**
     * @param ProductsCollection $collection
     */
    public function setAvailableProducts(ProductsCollection $collection)
    {
        if ($this->getMode() !== self::MODE_SERVICE) {
            throw new \DomainException("Adding products is only possible in Service Mode");
        }
        $this->availableProducts = $collection;
    }

    /**
     * @return ProductsCollection
     */
    public function getAvailableProducts()
    {
        return $this->availableProducts;
    }
}
