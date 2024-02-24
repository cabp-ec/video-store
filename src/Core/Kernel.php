<?php

declare(strict_types=1);

namespace Core;

use Core\Enums\PrintFormatEnum;
use Core\Interfaces\KartInterface;
use Core\Interfaces\PrintableInterface;
use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;
use Models\TransactionModel;


final class Kernel extends AbstractStoreManager
{
    private const CONTENT_TYPE = 'Content-Type: ';

    /**
     * @inheritDoc
     */
    public function executeTransaction(
        CustomerInterface   $customer,
        TransactionTypeEnum $transactionType = TransactionTypeEnum::QUOTATION
    ): TransactionInterface
    {
        return new TransactionModel($customer, $this->kart, $transactionType);
    }

    /**
     * @inheritDoc
     */
    public function runClassification(array $transactions): array
    {
        return $this->classificationService->run($transactions);
    }

    /**
     * @inheritDoc
     */
    public function runSubscription(array $transactions): array
    {
        return $this->subscriptionService->run($transactions);
    }

    /**
     * @inheritDoc
     */
    public function runTaxation(array $transactions): array
    {
        // TODO: implement
        return $transactions;
    }

    /**
     * @inheritDoc
     */
    public function printTransaction(
        TransactionInterface $transaction,
        PrintFormatEnum      $format = PrintFormatEnum::TEXT,
        ?string              $filePath = null
    ): void
    {
        header(self::CONTENT_TYPE . $this->reportingService->getMimeType($format));
        echo $this->reportingService->printTransaction($transaction, $format, $filePath);
    }

    /**
     * @inheritDoc
     */
    public function exportTransaction(
        TransactionInterface $transaction,
        PrintFormatEnum      $format = PrintFormatEnum::TEXT,
        ?string              $filePath = null
    ): bool
    {
        // TODO: implement
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getKart(): KartInterface
    {
        return $this->kart;
    }
}
