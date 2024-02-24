<?php

declare(strict_types=1);

namespace Core\Interfaces;

use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;
use Models\ProductModel;

interface VideoStoreInterface
{
    /**
     * Process a transaction for the given customer
     *
     * @param CustomerInterface $customer
     * @param TransactionTypeEnum $transactionType
     * @param ProductModel[] $products
     * @return TransactionInterface
     */
    public function executeTransaction(
        CustomerInterface   $customer,
        array               $products,
        TransactionTypeEnum $transactionType
    ): TransactionInterface;
}
