<?php

declare(strict_types=1);

namespace Services;

use Services\Interfaces\TransactionalServiceInterface;

final class TaxationService implements TransactionalServiceInterface
{
    private function runTaxationVertex(array &$transactions): array
    {
        // Call the VERTEX client
        // $this->vertexClient->calculateSale();
        return $transactions;
    }

    private function runTaxationBertaTax(array &$transactions): array
    {
        return $transactions;
    }

    public function runWithClient(array &$transactions, int $enumClient): array
    {
        // 1. Switch|Match for the client
        // Vertex Service
        // BertaTax Service
        // create method name
//        $name = 'runTaxationVertex';
        $name = 'runTaxationBertaTax';
        if (method_exists($this, $name)) {
            $this->$name($transactions);
        }

        // 2. Execute the call for the client
        return $transactions;
    }

    /**
     * @inheritDoc
     */
    public function run(array &$transactions): array
        // public function run(array &$transactions, $enumClient = null): array
    {
        return $transactions;
    }
}
