<?php

declare(strict_types=1);

require_once '../src/Autoloader.php';
Autoloader::run();

use Core\Kernel;
use Models\CustomerModel;


$service = new Kernel();

$quotationTransaction = $service->executeTransaction(
    new CustomerModel('John Doe', 'Boston'),
    []
);

echo '<pre>';
var_dump($quotationTransaction);

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
