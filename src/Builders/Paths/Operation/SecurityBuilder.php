<?php

namespace Vyuldashev\LaravelOpenApi\Builders\Paths\Operation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement;
use Vyuldashev\LaravelOpenApi\Attributes\SecurityRequirement as SecurityRequirementAttribute;
use Vyuldashev\LaravelOpenApi\RouteInformation;

class SecurityBuilder
{
    public function build(RouteInformation $route): array
    {
        return $route->actionAttributes
            ->filter(static fn (object $attribute) => $attribute instanceof SecurityRequirementAttribute)
            ->map(static function (SecurityRequirementAttribute $attribute) {
                if (!$attribute->scheme) {
                    return SecurityRequirement::create()->securityScheme(null);
                }
                $factory = app($attribute->scheme);
                $scheme = $factory->build();

                $requirement = SecurityRequirement::create()->securityScheme($scheme);

                if ($attribute->scopes) {
                    $requirement = $requirement->scopes(...$attribute->scopes);
                }

                return $requirement;
            })
            ->values()
            ->toArray();
    }
}