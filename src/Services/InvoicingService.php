<?php

declare(strict_types=1);

namespace Services;

use Models\Interfaces\TransactionInterface;
use Services\Interfaces\TransactionalServiceInterface;

class InvoicingService implements TransactionalServiceInterface
{
    /**
     * @inheritDoc
     */
    public function run(array &$transactions): array
    {
        return $transactions;
    }
}
