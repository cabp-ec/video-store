<?php

declare(strict_types=1);

namespace Models;

use Models\Enums\ProductRatingEnum;
use Models\Enums\ProductTypeEnum;

abstract class ProductModel extends AbstractBaseModel
{
    public function __construct(
        public readonly string                    $name,
        public readonly ProductTypeEnum           $type,
        public readonly float                     $unitPrice,
        public readonly ProductRatingEnum         $rate = ProductRatingEnum::NONE,
        public readonly ?MovieClassificationModel $classification = null,
        public readonly float                     $bulkPrice = 0.0,
        public readonly float                     $discount = 0.0
    )
    {
        $this->id = self::nextId();
    }
}
