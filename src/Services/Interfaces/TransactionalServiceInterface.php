<?php

declare(strict_types=1);

namespace Services\Interfaces;

use Exception;
use Models\Interfaces\TransactionInterface;

interface TransactionalServiceInterface
{
    /**
     * Execute the given transaction
     *
     * @param TransactionInterface[] $transactions
     * @return TransactionInterface[]
     */
    public function run(array &$transactions): array;
}
