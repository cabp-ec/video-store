<?php

declare(strict_types=1);

namespace Services;

use Models\Enums\MovieClassificationEnum;
use Models\MovieProductModel;
use Models\TransactionModel;
use Services\Interfaces\TransactionalServiceInterface;

final class SubscriptionService implements TransactionalServiceInterface
{
    private const RENT_TIME_FACTOR_NEW_RELEASE = 1;
    private const RENT_TIME_BONUS_NEW_RELEASE = 1;

    /**
     * Update Earned Points for the given transactions,
     *
     * @param TransactionModel[] $transactions
     * @return void
     */
    private function calculateEarnedPoints(array &$transactions): void
    {
        foreach ($transactions as &$transaction) {
            $items = $transaction->getKart()->getItems();
            $points = $transaction->getEarnedPoints();

            foreach ($items as &$kartItem) {
                /** @var MovieProductModel $movie */
                $movie = $kartItem->product;
                $isNewRelease = $movie->getMovieClassification() == MovieClassificationEnum::NEW_RELEASE;

                if ($isNewRelease && $kartItem->rentTime > self::RENT_TIME_FACTOR_NEW_RELEASE) {
                    $transaction->setEarnedPoints($points + self::RENT_TIME_BONUS_NEW_RELEASE);
                }
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function run(array &$transactions): array
    {
        $this->calculateEarnedPoints($transactions);
        // Run other 'subscription' stuff here

        return $transactions;
    }
}
