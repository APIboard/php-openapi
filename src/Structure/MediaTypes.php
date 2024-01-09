<?php

namespace Apiboard\OpenAPI\Structure;

use Apiboard\OpenAPI\Concerns\CanBeUsedAsArray;
use Apiboard\OpenAPI\References\JsonPointer;
use ArrayAccess;
use Countable;
use Iterator;

final class MediaTypes extends Structure implements ArrayAccess, Countable, Iterator
{
    use CanBeUsedAsArray;

    public function __construct(array $data, JsonPointer $pointer = null)
    {
        foreach ($data as $contentType => $value) {
            $data[$contentType] = new MediaType($contentType, $value);
        }

        parent::__construct($data, $pointer);
    }

    public function offsetGet(mixed $contentType): ?MediaType
    {
        return $this->data[$contentType] ?? null;
    }

    public function current(): MediaType
    {
        return $this->iterator->current();
    }

    public function json(): ?MediaType
    {
        return $this->offsetGet('application/json');
    }

    public function xml(): ?MediaType
    {
        return $this->offsetGet('application/xml');
    }
}
