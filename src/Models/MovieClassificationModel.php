<?php

declare(strict_types=1);

namespace Models;

use Models\Enums\MovieClassificationEnum;

class MovieClassificationModel extends AbstractBaseModel
{
    /**
     * Classification Constructor
     *
     * Use this model to handle custom product classifications
     * according to your store's organization
     *
     * @param MovieClassificationEnum $key
     * @param int|bool $value
     */
    public function __construct(
        public readonly MovieClassificationEnum $key,
        public readonly int|bool                $value
    )
    {
    }
}
