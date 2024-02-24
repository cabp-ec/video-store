<?php

declare(strict_types=1);

namespace Core;

use Core\Interfaces\VideoStoreInterface;
use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;
use Models\TransactionModel;

class Kernel implements VideoStoreInterface
{
    /**
     * @inheritDoc
     */
    public function executeTransaction(
        CustomerInterface   $customer,
        array               $products,
        TransactionTypeEnum $transactionType = TransactionTypeEnum::QUOTATION
    ): TransactionInterface
    {
        // TODO: Implement executeTransaction() method.
        // 1. Start transaction
        $transaction = new TransactionModel($customer, $transactionType, $products);

        // 2. Calculate bonuses
        // 3. Calculate taxes (using an external service?)

        return $transaction;
    }
}
