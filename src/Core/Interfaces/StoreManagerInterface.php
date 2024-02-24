<?php

declare(strict_types=1);

namespace Core\Interfaces;

use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;
use Models\ProductModel;

interface StoreManagerInterface
{
    /**
     * Get the kart instance
     *
     * @return KartInterface
     */
    public function getKart(): KartInterface;

    /**
     * Process a transaction for the given customer,
     * requires some products in the kart before execution
     *
     * @param CustomerInterface $customer
     * @param TransactionTypeEnum $transactionType
     * @return TransactionInterface
     */
    public function executeTransaction(
        CustomerInterface   $customer,
        TransactionTypeEnum $transactionType
    ): TransactionInterface;

    /**
     * Run the whole set of features from the Classification Service
     * for the given transactions
     *
     * @param array $transactions
     * @return array
     */
    public function runClassification(array $transactions): array;

    /**
     * Run the whole set of features from the Subscription Service
     * for the given transactions
     *
     * @param array $transactions
     * @return array
     */
    public function runSubscription(array $transactions): array;

    /**
     * Calculate taxes for the given transactions
     *
     * @param array $transactions
     * @return array
     */
    public function runTaxation(array $transactions): array;
}
