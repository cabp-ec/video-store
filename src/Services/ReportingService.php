<?php

declare(strict_types=1);

namespace Services;

use Core\Enums\PrintFormatEnum;
use Error;
use Models\Interfaces\TransactionInterface;

class ReportingService
{
    private string $ds = DIRECTORY_SEPARATOR;
    private string $tplBaseDir;

    public function __construct()
    {
        $this->tplBaseDir = dirname(__DIR__, 2) . $this->ds . 'resources' . $this->ds . 'templates';
    }

    /**
     * Get the given transaction in TEXT format
     *
     * @param TransactionInterface $transaction
     * @return string
     */
    private function printTransactionAsText(TransactionInterface $transaction): string
    {
        $tplFilePath = $this->tplBaseDir . $this->ds . 'text.tpl.php';

        if (!file_exists($tplFilePath)) {
            throw new Error('TEXT template not found');
        }

        $customer = $transaction->getCustomer();
        $kart = $transaction->getKart();
        $kartItems = $kart->getItems();

        /*foreach ($kartItems as $kartItem) {
            echo $kartItem->product->name . "\t";
            echo $kartItem->getPrice() . "\t";
            echo $kartItem->qty . "\t";
            echo $kartItem->rentTime . "\t";
            echo $kartItem->getTotalPrice() . "\t";
            echo "\n";
        }*/

//        echo "\nTOTAL: " . $transaction->getTotal();
//        echo "\nPOINTS: " . $transaction->getEarnedPoints();

        $content = include($tplFilePath);
//        echo $content;
//        var_dump($items);
//        exit;

        return $content;
    }

    /**
     * Get the given transaction in HTML format
     *
     * @param TransactionInterface $transaction
     * @return string
     */
    private function printTransactionAsHtml(TransactionInterface $transaction): string
    {
        $tplFilePath = $this->tplBaseDir . $this->ds . 'html.tpl.php';

        if (!file_exists($tplFilePath)) {
            throw new Error('HTML template not found');
        }

        $customer = $transaction->getCustomer();
        $kart = $transaction->getKart();
        $kartItems = $kart->getItems();

        return include($tplFilePath);
    }

    /**
     * Get the given transaction in PDF format
     *
     * @param TransactionInterface $transaction
     * @return string
     */
    private function printTransactionAsPdf(TransactionInterface $transaction): string
    {
        // TODO: implement PDF print
        return 'implement PDF print';
    }

    /**
     * Get the given transaction in MARKDOWN format
     *
     * @param TransactionInterface $transaction
     * @return string
     */
    private function printTransactionAsMarkdown(TransactionInterface $transaction): string
    {
        // TODO: implement MARKDOWN print
        return 'implement MARKDOWN print';
    }

    public function printTransaction(
        TransactionInterface $transaction,
        PrintFormatEnum      $format,
        ?string              $filePath = null
    ): string
    {

        $content = match ($format) {
            PrintFormatEnum::HTML => $this->printTransactionAsHtml($transaction),
            PrintFormatEnum::PDF => $this->printTransactionAsPdf($transaction),
            PrintFormatEnum::MARKDOWN => $this->printTransactionAsMarkdown($transaction),
            default => $this->printTransactionAsText($transaction),
        };

        if ($filePath) {
            // TODO: write the output file
            return $filePath;
        }

        return $content;
    }

    /**
     * Get the mime type for the given format
     *
     * @param PrintFormatEnum $format
     * @return string
     */
    public function getMimeType(PrintFormatEnum $format): string
    {
        return match ($format) {
            PrintFormatEnum::HTML => 'text/html; charset=UTF-8',
            PrintFormatEnum::PDF => 'application/pdf',
            PrintFormatEnum::MARKDOWN => 'text/x-markdown',
            default => 'text/plain'
        };
    }
}
