<?php

declare(strict_types=1);

namespace Core\Interfaces;

use Core\Enums\PrintFormatEnum;
use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;
use Models\ProductModel;

interface StoreManagerInterface
{
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

    /**
     * Get the given transaction in the given format,
     * including its mime type
     *
     * @param TransactionInterface $transaction
     * @param PrintFormatEnum $format
     * @param string|null $filePath
     * @return void
     */
    public function printTransaction(
        TransactionInterface $transaction,
        PrintFormatEnum      $format = PrintFormatEnum::TEXT
    ): void;

    /**
     * Export the given transaction TO A FILE, in the given format
     *
     * @param TransactionInterface $transaction
     * @param PrintFormatEnum $format
     * @param string|null $filePath
     * @return bool
     */
    public function exportTransactionToFile(
        TransactionInterface $transaction,
        PrintFormatEnum      $format = PrintFormatEnum::TEXT,
        ?string              $filePath = null
    ): bool;

    /**
     * Get the kart instance
     *
     * @return KartInterface
     */
    public function getKart(): KartInterface;
}
