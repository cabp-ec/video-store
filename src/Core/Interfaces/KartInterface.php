<?php

declare(strict_types=1);

namespace Core\Interfaces;

use Models\KartItem;
use Models\ProductModel;

interface KartInterface
{
    /**
     * Add a product to the cart
     *
     * @param ProductModel $product
     * @param int $qty
     * @param int $rentTime
     * @return KartInterface
     */
    public function addItem(ProductModel $product, int $qty, int $rentTime = 0): self;

    /**
     * Add a product to the cart
     *
     * @param int $id
     * @param int $qty
     * @return KartInterface
     */
    public function removeItem(int $id, int $qty): self;

    /**
     * Get all kart items
     *
     * @return KartItem[]
     */
    public function getItems(): array;
}
