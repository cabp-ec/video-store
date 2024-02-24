<?php

declare(strict_types=1);

namespace Models;

use DateTimeInterface;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;

class CustomerModel extends AbstractBaseModel implements CustomerInterface
{
    /**
     * @param string $name
     * @param string $address
     * @param TransactionInterface[] $transactions
     */
    public function __construct(
        private string $name,
        private string $address,
        private array  $transactions = [],
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getTransactions(DateTimeInterface $from = null, DateTimeInterface $to = null): array
    {
        return [];
    }
}
