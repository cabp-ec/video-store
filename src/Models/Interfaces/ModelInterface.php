<?php

declare(strict_types=1);

namespace Models\Interfaces;

interface ModelInterface
{
    /**
     * Get the model ID
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Save the model in the database
     *
     * @return bool
     */
    public function save(): bool;
}
