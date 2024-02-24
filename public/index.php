<?php

declare(strict_types=1);

require_once '../src/Autoloader.php';
Autoloader::run();

use Core\Kernel;
use Models\CustomerModel;
use Models\Enums\MovieClassificationEnum;
use Models\Enums\ProductRatingEnum;
use Models\TransactionModel;
use Models\MovieClassificationModel;
use Models\MovieProductModel;


// TODO: enable/disable demo mode
// 1. Create custom classifications
$classificationRegular = new MovieClassificationModel(MovieClassificationEnum::REGULAR, 0);
$classificationChildren = new MovieClassificationModel(MovieClassificationEnum::CHILDREN, 2);
$classificationNewRelease = new MovieClassificationModel(MovieClassificationEnum::NEW_RELEASE, 1);

// 2. Create some products
$predator_1 = new MovieProductModel(
    'Predator I',
    1987,
    $classificationRegular,
    0.0,
    ProductRatingEnum::RATED_PG_13
);
$predator_2 = new MovieProductModel(
    'Predator II',
    1990,
    $classificationRegular,
    0.0,
    ProductRatingEnum::RATED_PG_13
);
$samaritan_2 = new MovieProductModel(
    'Samaritan II',
    2025,
    $classificationNewRelease,
    0.0,
    ProductRatingEnum::RATED_PG
);
$spiderman_and_friends = new MovieProductModel(
    'Spiderman and Friends',
    2020,
    $classificationChildren,
    0.0,
    ProductRatingEnum::RATED_PG_13
);
$leather_goddesses_of_phobos = new MovieProductModel(
    'Leather Goddesses of Phobos',
    2020,
    $classificationNewRelease,
    0.0,
    ProductRatingEnum::RATED_NC_17
);

// 3. A customer
$customerJohnDoe = new CustomerModel('John Doe', 'Boston');

// 4. Add products to the kart
$service = new Kernel();

$kart = $service->getKart();
$kart->addItem($predator_1, 1, 1)
//    ->addItem($predator_2, 1, 3)
    ->addItem($samaritan_2, 1, 3)
    ->addItem($spiderman_and_friends, 1, 1);

// 5. Execute transaction
/** @var TransactionModel $quotation */
$quotation = $service->runTaxation(
    $service->runSubscription(
        $service->runClassification([
            $service->executeTransaction($customerJohnDoe),
        ])
    )
)[0];

echo '<pre>';
echo 'Total: ' . $quotation->getTotal() . '<br>';
echo 'Points: ' . $quotation->getEarnedPoints() . '<br>';

/*
$codedir = '../VideoStoreService';

require_once("$codedir/Movie.php");
require_once("$codedir/Rental.php");
require_once("$codedir/Customer.php");

$prognosisNegative = new Movie("Prognosis Negative", Movie::NEW_RELEASE);
$sackLunch = new Movie("Sack Lunch", Movie::CHILDRENS);
$painAndYearning = new Movie("The Pain and the Yearning", Movie::REGULAR);

$customer = new Customer("Susan Ross");
$customer->addRental(
  new Rental($prognosisNegative, 3)
);
$customer->addRental(
  new Rental($painAndYearning, 1)
);
$customer->addRental(
  new Rental($sackLunch, 1)
);

$statement = $customer->statement();

echo '<pre>';
echo $statement;
echo '</pre>';
*/
