<?php

declare(strict_types=1);

namespace Models;

use Models\Enums\TransactionTypeEnum;
use Models\Interfaces\CustomerInterface;
use Models\Interfaces\TransactionInterface;

class TransactionModel extends AbstractBaseModel implements TransactionInterface
{
    public readonly float $total;

    /**
     * Transaction Model Constructor
     *
     * @param CustomerInterface $customer
     * @param TransactionTypeEnum $type
     * @param ProductModel[] $products
     */
    public function __construct(
        private readonly CustomerInterface $customer,
        private TransactionTypeEnum        $type = TransactionTypeEnum::QUOTATION,
        private array                      $products = []
    )
    {
        $this->id = self::nextId();
        $this->total = 0.0;
    }

    /**
     * @inheritDoc
     */
    public function getCustomer(): CustomerInterface
    {
        return $this->customer;
    }

    /**
     * @inheritDoc
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @inheritDoc
     */
    public function setProducts(array $values): void
    {
        $this->products = $values;
    }

    /**
     * @inheritDoc
     */
    public function run(): bool
    {
        // TODO: Implement run() method.
        // 1. Calculate total value

        return false;
    }

    /**
     * @inheritDoc
     */
    public function setType(TransactionTypeEnum $value): bool
    {
        $this->type = $value;
        return $this->run();
    }
}
