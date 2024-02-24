<?php

declare(strict_types=1);

$textReport = 'Rental Record for ' . $customer->getName() . "\n\n";

foreach ($kartItems as $kartItem) {
    $textReport .= "\t" . $kartItem->product->name . ":\t" . $kartItem->getTotalPrice();
    $textReport .= ' (' . $kartItem->rentTime . " days)\n";
}

$textReport .= "\nAmount owed is " . $transaction->getTotal();
$textReport .= "\nYou earned " . $transaction->getEarnedPoints() . ' frequent renter points';

return $textReport;
