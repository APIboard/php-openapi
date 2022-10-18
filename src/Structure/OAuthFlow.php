<?php

namespace Apiboard\OpenAPI\Structure;

final class OAuthFlow
{
    private string $type;

    private array $data;

    public function __construct(string $type, array $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function authorizationUrl(): ?string
    {
        return $this->data['authorizationUrl'] ?? null;
    }

    public function tokenUrl(): ?string
    {
        return $this->data['tokenUrl'] ?? null;
    }

    public function refreshUrl(): ?string
    {
        return $this->data['refreshUrl'] ?? null;
    }

    public function scopes(): ?array
    {
        return $this->data['scopes'] ?? null;
    }
}