<?php

declare(strict_types=1);

namespace Models\Enums;

enum ProductTypeEnum
{
    case MOVIE_DVD;
    case MOVIE_BLUE_RAY;
    case MOVIE_ONLINE;
    case MOVIE_VHS;
    case FOOD_BEVERAGES;
}
