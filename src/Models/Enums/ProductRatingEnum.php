<?php

declare(strict_types=1);

namespace Models\Enums;

enum ProductRatingEnum
{
    case NONE;
    case RATED_G;
    case RATED_PG;
    case RATED_PG_13;
    case RATED_R;
    case RATED_NC_17;
}
