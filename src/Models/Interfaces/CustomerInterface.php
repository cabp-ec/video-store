<?php

declare(strict_types=1);

namespace Models\Interfaces;

use DateTimeInterface;

interface CustomerInterface extends ModelInterface
{
    /**
     * Get transactions performed a Customer during a period of time
     *
     * @param DateTimeInterface|null $from
     * @param DateTimeInterface|null $to
     * @return TransactionInterface[]
     */
    public function getTransactions(DateTimeInterface $from = null, DateTimeInterface $to = null): array;
}
