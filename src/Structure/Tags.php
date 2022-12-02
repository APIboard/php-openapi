<?php

namespace Apiboard\OpenAPI\Structure;

use Apiboard\OpenAPI\Concerns\AsCountableArrayIterator;
use ArrayAccess;
use Countable;
use Iterator;

final class Tags implements ArrayAccess, Countable, Iterator
{
    use AsCountableArrayIterator;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = array_map(fn (array $value) => new Tag($value), $data);
    }

    public function offsetGet(mixed $offset): ?Tag
    {
        return $this->data[$offset] ?? null;
    }
}
