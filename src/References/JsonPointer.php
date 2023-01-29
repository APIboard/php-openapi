<?php

namespace Apiboard\OpenAPI\References;

use InvalidArgumentException;

class JsonPointer
{
    private string $filename;

    /**
     * @var array<array-key,string>
     */
    private array $propertyPaths = [];

    public function __construct(string $value)
    {
        if (is_string($value) === false) {
            throw new InvalidArgumentException('Ref value must be a string');
        }

        $splitRef = explode('#', $value, 2);

        $this->filename = $splitRef[0];

        if (array_key_exists(1, $splitRef)) {
            $this->propertyPaths = $this->decodePropertyPaths($splitRef[1]);
        }
    }

    /**
     * @param  string  $propertyPathString
     * @return string[]
     */
    private function decodePropertyPaths($propertyPathString)
    {
        $paths = [];
        foreach (explode('/', trim($propertyPathString, '/')) as $path) {
            $path = $this->decodePath($path);

            if (is_string($path) && '' !== $path) {
                $paths[] = $path;
            }
        }

        return $paths;
    }

    /**
     * @param  string  $path
     * @return string
     */
    private function decodePath($path)
    {
        return strtr($path, ['~1' => '/', '~0' => '~', '%25' => '%']);
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return array<array-key,string>
     */
    public function getPropertyPaths(): array
    {
        return $this->propertyPaths;
    }
}