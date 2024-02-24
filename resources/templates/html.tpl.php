<?php

declare(strict_types=1);

$htmlReport = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width"/>
  <meta name="theme-color" content="#F4F4F4">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="author" content="Carlos Arturo Bucheli Padilla">
  <meta name="description" content="Carlos Arturo Bucheli Padilla, Master of Business and Technology{% if openGraph %} {{ openGraph.description }}{% endif %}">

  <!-- https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP -->
  <meta
    http-equiv="Content-Security-Policy"
    content="default-src \'self\'; script-src \'self\'; style-src \'self\'"
        />

  <title>HTML Report</title>
</head>';

$htmlReport .= '<body>';
$htmlReport .= '<h1>Rentals for ' . $customer->getName() . '</h1>';

foreach ($kartItems as $kartItem) {
    $htmlReport .= '<div>';
    $htmlReport .= '<h4>' . $kartItem->product->name . ':</h4>';
    $htmlReport .= '<p>Total Charged: <em>' . $transaction->getTotal() . '</em></p>';
    $htmlReport .= '<p>Earned Renter Points: <em>' . $transaction->getEarnedPoints() . '</em></p>';
    $htmlReport .= '</div>';
}

$htmlReport .= '</body>';
$htmlReport .= '</html>';

return $htmlReport;
