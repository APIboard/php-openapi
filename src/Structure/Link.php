<?php

namespace Apiboard\OpenAPI\Structure;

use Apiboard\OpenAPI\Concerns\CanBeDescribed;
use JsonSchema\Entity\JsonPointer;

final class Link
{
    use CanBeDescribed;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function operationId(): ?string
    {
        return $this->data['operationId'] ?? null;
    }

    public function operationRef(): ?JsonPointer
    {
        $operationRef = $this->data['operationRef'] ?? null;

        if ($operationRef === null) {
            return null;
        }

        return new JsonPointer($operationRef);
    }

    public function parameters(): ?array
    {
        $parameters = $this->data['parameters'] ?? null;

        if ($parameters === null) {
            return null;
        }

        foreach ($parameters as $name=>$expression) {
            $parameters[$name] = new RuntimeExpression($name, $expression);
        }

        return $parameters;
    }

    public function requestBody(): ?RuntimeExpression
    {
        $requestBody = $this->data['requestBody'] ?? null;

        if ($requestBody === null) {
            return null;
        }

        return new RuntimeExpression('requestBody', $requestBody);
    }

    public function server(): ?Server
    {
        $server = $this->data['server'] ?? null;

        if ($server === null) {
            return null;
        }

        return new Server($server);
    }
}