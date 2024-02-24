<?php

declare(strict_types=1);

namespace Models;

use Models\Interfaces\ModelInterface;

abstract class AbstractBaseModel implements ModelInterface
{
    protected int $id;

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function save(): bool
    {
        // TODO: implement saving into the DB using doctrine
        return false;
    }

    /**
     * Get the next id when creating a new instance of this model
     *
     * @return int
     */
    static protected function nextId(): int
    {
        // TODO: implement
        return 1;
    }
}
