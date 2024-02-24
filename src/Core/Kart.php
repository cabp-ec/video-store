<?php

declare(strict_types=1);

namespace Core;

use Core\Interfaces\KartInterface;
use Error;
use Models\KartItem;
use Models\ProductModel;

final class Kart implements KartInterface
{
    /**
     * @param KartItem[] $kartItems
     */
    public function __construct(private array $kartItems = [])
    {
    }

    /**
     * Get a product from the pool, if it exists
     *
     * @param int $id
     * @return ProductModel|null
     */
    private function findProduct(int $id): ProductModel|null
    {
        $output = null;

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function addItem(ProductModel $product, int $qty, int $rentTime = 0): KartInterface
    {
        if ($qty <= 0) {
            throw new Error('You need to add at least 1 product');
        }

        $this->kartItems[] = new KartItem($product, $qty, $rentTime);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeItem(int $id, int $qty): KartInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->kartItems;
    }
}
