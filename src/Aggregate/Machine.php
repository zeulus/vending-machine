<?php
declare(strict_types=1);

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
     * Machine constructor. On initialize, set operating mode to normal.
     */
    public function __construct()
    {
        $this->changeMode(self::MODE_NORMAL);
    }

    /**
     * @param Coin $coin
     */
    public function insertCoin(Coin $coin): void
    {
        $this->insertedCoins[] = $coin;
    }

    /**
     * @return int
     */
    public function getCredits(): int
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
    public function changeMode($mode): void
    {
        if ( ! in_array($mode, [self::MODE_NORMAL, self::MODE_SERVICE])) {
            throw new \InvalidArgumentException("Machine cannot operate in such mode.");
        }
        $this->mode = $mode;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @return array Coin[]
     */
    public function returnCoins(): array
    {
        $allCoins            = $this->insertedCoins;
        $this->insertedCoins = [];

        return $allCoins;
    }

    /**
     * @param ProductsCollection $collection
     */
    public function setAvailableProducts(ProductsCollection $collection): void
    {
        if ($this->getMode() !== self::MODE_SERVICE) {
            throw new \DomainException("Adding products is only possible in Service Mode");
        }
        $this->availableProducts = $collection;
    }

    /**
     * @return ProductsCollection
     */
    public function getAvailableProducts(): ProductsCollection
    {
        return $this->availableProducts;
    }
}
