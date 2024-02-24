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
     * @param int $releaseYear
     * @param MovieClassificationModel $classification
     * @param float $unitPrice
     * @param ProductTypeEnum $type
     * @param ProductRatingEnum $rate
     * @param bool $hasCaptions
     */
    public function __construct(
        string                           $name,
        public readonly int              $releaseYear,
        private MovieClassificationModel $classification,
        float                            $unitPrice,
        ProductRatingEnum                $rate = ProductRatingEnum::RATED_G,
        ProductTypeEnum                  $type = ProductTypeEnum::MOVIE_DVD,
        public readonly bool             $hasCaptions = false
    )
    {
        parent::__construct($name, $type, $unitPrice, $rate);
    }

    /**
     * Get the movie classification
     *
     * @return MovieClassificationModel $value
     */
    public function getMovieClassification(): MovieClassificationModel
    {
        return $this->classification;
    }

    /**
     * Change the movie classification
     *
     * @param MovieClassificationModel $value
     * @return void
     */
    public function setMovieClassification(MovieClassificationModel $value): void
    {
        $this->classification = $value;
    }
}
