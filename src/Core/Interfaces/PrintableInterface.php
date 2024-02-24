<?php

declare(strict_types=1);

namespace Core\Interfaces;

interface PrintableInterface
{
    /**
     * Get the MIME TYPE of the printable object
     *
     * @return string
     */
    public function getMimeType(): string;

    /**
     * Get the CONTENT of the printable object
     *
     * @return string
     */
    public function getContent(): string;
}
