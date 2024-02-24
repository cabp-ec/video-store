<?php

declare(strict_types=1);

namespace Models;

use Models\Enums\ProductRatingEnum;
use Models\Enums\ProductTypeEnum;

class MovieProductModel extends ProductModel
{
    /**
     * Movie Model Constructor
     *
     * @param string $name
     * @param MovieClassificationModel $classification
     * @param float $unitPrice
     * @param ProductTypeEnum $type
     * @param ProductRatingEnum $rate
     */
    public function __construct(
        string                   $name,
        MovieClassificationModel $classification,
        float                    $unitPrice,
        ProductTypeEnum          $type = ProductTypeEnum::MOVIE_DVD,
        ProductRatingEnum        $rate = ProductRatingEnum::RATED_G
    )
    {
        parent::__construct($name, $type, $unitPrice, $rate, $classification);
    }
}
