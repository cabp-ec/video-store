<?php

declare(strict_types=1);

namespace Services;

use Models\Enums\MovieClassificationEnum;
use Models\KartItem;
use Models\MovieProductModel;
use Models\TransactionModel;
use Services\Interfaces\TransactionalServiceInterface;

final class ClassificationService implements TransactionalServiceInterface
{
    // TODO: the following constants should be taken from the ENV (e.g. a .env file for the local ENV)
    private const PRICE_REGULAR = 2;
    private const PRICE_CHILDREN = 1.5;
    private const RENT_TIME_LIMIT_REGULAR = 2;
    private const RENT_TIME_LIMIT_CHILDREN = 3;
    private const DECREASE_FACTOR_REGULAR = 2;
    private const DECREASE_FACTOR_CHILDREN = 3;
    private const RENT_FACTOR_REGULAR = 1.5;
    private const RENT_FACTOR_NEW_RELEASE = 3;
    private const RENT_FACTOR_CHILDREN = 1.5;

    /**
     * Calculate the REGULAR pricing for the given kart item
     *
     * @param KartItem $kartItem
     * @return void
     */
    private function calculateItemPriceRegular(KartItem $kartItem): float
    {
        $price = $kartItem->getPrice() + self::PRICE_REGULAR;

        if ($kartItem->rentTime > self::RENT_TIME_LIMIT_REGULAR) {
            $price += ($kartItem->rentTime - self::DECREASE_FACTOR_REGULAR) * self::RENT_FACTOR_REGULAR;
        }

        return $price;
    }

    /**
     * Calculate the NEW RELEASE pricing for the given kart item
     *
     * @param KartItem $kartItem
     * @return float
     */
    private function calculateItemPriceNewRelease(KartItem $kartItem): float
    {
        $price = $kartItem->getPrice();
        $price += $kartItem->rentTime * self::RENT_FACTOR_NEW_RELEASE;
        return $price;
    }

    /**
     * Calculate the CHILDREN pricing for the given kart item
     *
     * @param KartItem $kartItem
     * @return float
     */
    private function calculateItemPriceChildren(KartItem $kartItem): float
    {
        $price = $kartItem->getPrice() + self::PRICE_CHILDREN;

        if ($kartItem->rentTime > self::RENT_TIME_LIMIT_CHILDREN) {
            $price += ($kartItem->rentTime - self::DECREASE_FACTOR_CHILDREN) * self::RENT_FACTOR_CHILDREN;
        }

        return $price;
    }

    /**
     * Update pricing for the given transactions,
     * based on custom classifications
     *
     * @param TransactionModel[] $transactions
     * @return void
     */
    private function calculatePricing(array &$transactions): void
    {
        foreach ($transactions as &$transaction) {
            $items = $transaction->getKart()->getItems();
            $total = $transaction->getTotal();

            foreach ($items as &$kartItem) {
                /** @var MovieProductModel $movie */
                $movie = $kartItem->product;
                $itemPrice = $kartItem->getPrice();

                switch ($movie->getMovieClassification()->key) {
                    case (MovieClassificationEnum::REGULAR):
                        $itemPrice = $this->calculateItemPriceRegular($kartItem);
                        break;
                    case (MovieClassificationEnum::NEW_RELEASE):
                        $itemPrice = $this->calculateItemPriceNewRelease($kartItem);
                        break;
                    case (MovieClassificationEnum::CHILDREN):
                        $itemPrice = $this->calculateItemPriceChildren($kartItem);
                        break;
                }

                $kartItem->setPrice($itemPrice);
                $kartItem->setTotalPrice($itemPrice * $kartItem->qty);
                $total += $itemPrice;
            }

            $transaction->setTotal($total);
        }
    }

    /**
     * @inheritDoc
     */
    public function run(array &$transactions): array
    {
        $this->calculatePricing($transactions);
        // Run other 'classification' stuff here

        return $transactions;
    }
}
