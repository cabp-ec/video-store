<?php

declare(strict_types=1);

namespace Models;

use Core\Interfaces\KartInterface;
use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;

class TransactionModel extends AbstractBaseModel implements TransactionInterface
{
    private float $subTotal;
    private float $total;
    private int $earnedPoints = 0;

    /**
     * Transaction Model Constructor
     *
     * @param CustomerInterface $customer
     * @param KartInterface $kart
     * @param TransactionTypeEnum $type
     */
    public function __construct(
        private readonly CustomerInterface $customer,
        private readonly KartInterface     $kart,
        private TransactionTypeEnum        $type = TransactionTypeEnum::QUOTATION
    )
    {
        $this->id = self::nextId();
        $this->subTotal = 0.0;
        $this->total = 0.0;
        $this->run();
    }


    /**
     * @inheritDoc
     */
    public function run(): void
    {
        $this->subTotal = 0;
        $items = $this->kart->getItems();

        // 1. Calculate sub-totals and per-item stuff
        foreach ($items as $kartItem) {
            $this->subTotal += $kartItem->getPrice() * $kartItem->qty;
            $this->earnedPoints++;
        }

        // 2. Calculate grand total
        $this->total = $this->subTotal;
    }

    /**
     * @inheritDoc
     */
    public function setType(TransactionTypeEnum $value): void
    {
        $this->type = $value;
        $this->run();
    }

    /**
     * @inheritDoc
     */
    public function getCustomer(): CustomerInterface
    {
        return $this->customer;
    }

    /**
     * @inheritDoc
     */
    public function getKart(): KartInterface
    {
        return $this->kart;
    }

    /**
     * @inheritDoc
     */
    public function getEarnedPoints(): int
    {
        return $this->earnedPoints;
    }

    /**
     * @inheritDoc
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @inheritDoc
     */
    public function setEarnedPoints(int $value): void
    {
        $this->earnedPoints = $value;
    }

    /**
     * @inheritDoc
     */
    public function setTotal(float $value): void
    {
        $this->total = $value;
    }
}
