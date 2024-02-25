<?php

declare(strict_types=1);

namespace Core\Enums;

enum PrintFormatEnum
{
    case TEXT;
    case HTML;
    case PDF;
    case MARKDOWN;
    case JSON;
}
