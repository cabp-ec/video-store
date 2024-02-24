<?php

declare(strict_types=1);

namespace Models\Enums;

enum TransactionTypeEnum
{
    case SALE;
    case QUOTATION;
}
