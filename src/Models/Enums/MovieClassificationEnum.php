<?php

declare(strict_types=1);

namespace Models\Enums;

enum MovieClassificationEnum
{
    case REGULAR;
    case CHILDREN;
    case NEW_RELEASE;
}
