<?php

declare(strict_types=1);

namespace Models;

class KartItem
{
    public function __construct(
        public readonly ProductModel $product,
        public int                   $qty,
        public int                   $rentTime,
        private float                $price = 0.0
    )
    {
        if ($this->rentTime < 0) {
            throw new \Error('Rental time cannot be a negate value');
        }

        if ($this->price < 0) {
            throw new \Error('Price cannot be a negate value');
        }
    }

    /**
     * Get the base unit price (i.e. before taxation)
     *
     * @return float
     */
    public function calculateBasePrice(): float
    {
        $this->price = $this->rentTime > 0
            ? ($this->rentTime * $this->product->unitPrice)
            : $this->product->unitPrice;

        return $this->price;
    }

    /**
     * Get the unit price for the item (i.e. after any calculation)
     *
     * @return float
     */
    public function getPrice(): float
    {
        $this->calculateBasePrice();
        // Do other necessary calculations here

        return $this->price;
    }

    /**
     * Set the item price
     *
     * @param float $value
     * @return void
     */
    public function setPrice(float $value): void
    {
        $this->price = $value;
    }
}
