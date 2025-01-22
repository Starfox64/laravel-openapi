<?php

namespace Vyuldashev\LaravelOpenApi\Attributes;

use Attribute;
use InvalidArgumentException;
use Vyuldashev\LaravelOpenApi\Factories\SecuritySchemeFactory;

#[Attribute(Attribute::TARGET_METHOD)]
class Operation
{
    public ?string $id;

    /** @var array<string> */
    public array $tags;

    public ?string $method;

    public ?array $servers;

    /**
     * @param  string|null  $id
     * @param  array  $tags
     * @param  string|null  $method
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $id = null, array $tags = [], string $method = null, array $servers = null)
    {
        $this->id = $id;
        $this->tags = $tags;
        $this->method = $method;
        $this->servers = $servers;
    }
}
