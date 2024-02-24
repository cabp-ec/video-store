<?php

declare(strict_types=1);

namespace Models\Interfaces;

use Core\Interfaces\KartInterface;
use Models\Enums\TransactionTypeEnum;
use Models\ProductModel;

interface TransactionInterface
{
    /**
     * Execute the current transaction
     * TODO: calculate in-bulk purchases
     *
     * @return void
     */
    public function run(): void;

    /**
     * Set the transaction type, this causes a re-run
     *
     * @param TransactionTypeEnum $value
     * @return void
     */
    public function setType(TransactionTypeEnum $value): void;

    /**
     * Get the Customer owner of this transaction
     *
     * @return CustomerInterface
     */
    public function getCustomer(): CustomerInterface;

    /**
     * Get the kart instance
     *
     * @return KartInterface
     */
    public function getKart(): KartInterface;

    /**
     * Get the earned points in the current transaction
     *
     * @return int
     */
    public function getEarnedPoints(): int;

    /**
     * Get the total value for the current transaction
     *
     * @return float
     */
    public function getTotal(): float;

    /**
     * Set the points earned in the current transaction
     *
     * @param int $value
     * @return void
     */
    public function setEarnedPoints(int $value): void;

    /**
     * Set the total value for the current transaction
     *
     * @param float $value
     * @return void
     */
    public function setTotal(float $value): void;
}
