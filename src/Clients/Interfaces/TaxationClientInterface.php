<?php

declare(strict_types=1);

namespace Clients\Interfaces;

use Models\Interfaces\TransactionInterface;

interface TaxationClientInterface
{
    /**
     * Calculate taxes for a sale transaction
     *
     * @param TransactionInterface $transaction
     * @return TransactionInterface
     */
    public function calculateSale(TransactionInterface $transaction): TransactionInterface;

    /**
     * Calculate taxes for a quotation transaction
     *
     * @param TransactionInterface $transaction
     * @return TransactionInterface
     */
    public function calculateQuotation(TransactionInterface $transaction): TransactionInterface;
}
