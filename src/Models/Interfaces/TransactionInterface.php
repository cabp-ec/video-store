<?php

declare(strict_types=1);

namespace Models\Interfaces;

use Models\Enums\TransactionTypeEnum;
use Models\ProductModel;

interface TransactionInterface
{
    /**
     * Get the Customer owner of this transaction
     *
     * @return CustomerInterface
     */
    public function getCustomer(): CustomerInterface;

    /**
     * Get all products involved in the current transaction
     *
     * @return array
     */
    public function getProducts(): array;

    /**
     * Set products involved in the current transaction
     *
     * @param ProductModel[] $values
     * @return void
     */
    public function setProducts(array $values): void;

    /**
     * Execute the current transaction
     *
     * @return bool
     */
    public function run(): bool;

    /**
     * Set the transaction type, this causes a re-run
     *
     * @param TransactionTypeEnum $value
     * @return bool
     */
    public function setType(TransactionTypeEnum $value): bool;
}
