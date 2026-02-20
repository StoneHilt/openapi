<?php

namespace StoneHilt\OpenApi\Concerns;

use StoneHilt\OpenApi\Objects\Schema;
use InvalidArgumentException;
use StoneHilt\OpenApi\Contracts\Reusable;
use StoneHilt\OpenApi\Factories\CallbackFactory;
use StoneHilt\OpenApi\Factories\ParametersFactory;
use StoneHilt\OpenApi\Factories\RequestBodyFactory;
use StoneHilt\OpenApi\Factories\ResponseFactory;
use StoneHilt\OpenApi\Factories\SchemaFactory;
use StoneHilt\OpenApi\Factories\SecuritySchemeFactory;

trait Referencable
{
    public static function ref(?string $objectId = null): Schema
    {
        $instance = app(static::class);

        if (! $instance instanceof Reusable) {
            throw new InvalidArgumentException('"'.static::class.'" must implement "'.Reusable::class.'" in order to be referencable.');
        }

        $baseRef = null;

        if ($instance instanceof CallbackFactory) {
            $baseRef = '#/components/callbacks/';
        } elseif ($instance instanceof ParametersFactory) {
            $baseRef = '#/components/parameters/';
        } elseif ($instance instanceof RequestBodyFactory) {
            $baseRef = '#/components/requestBodies/';
        } elseif ($instance instanceof ResponseFactory) {
            $baseRef = '#/components/responses/';
        } elseif ($instance instanceof SchemaFactory) {
            $baseRef = '#/components/schemas/';
        } elseif ($instance instanceof SecuritySchemeFactory) {
            $baseRef = '#/components/securitySchemes/';
        }

        return Schema::ref($baseRef.$instance->build()->objectId, $objectId);
    }
}
