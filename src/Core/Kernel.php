<?php

declare(strict_types=1);

namespace Core;

use Core\Interfaces\KartInterface;
use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;
use Models\TransactionModel;


final class Kernel extends AbstractStoreManager
{
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
    public function getKart(): KartInterface
    {
        return $this->kart;
    }
}
