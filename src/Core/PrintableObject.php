<?php

declare(strict_types=1);

namespace Core;

use Core\Interfaces\PrintableInterface;

final readonly class PrintableObject implements PrintableInterface
{
    /**
     * Printable Object Constructor
     *
     * @param string $mimeType
     * @param string $content
     */
    public function __construct(
        private string $mimeType,
        private string $content
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
