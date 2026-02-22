<?php

namespace StoneHilt\OpenApi\Builders;

use StoneHilt\OpenApi\Objects\Components;
use StoneHilt\OpenApi\Builders\Components\CallbacksBuilder;
use StoneHilt\OpenApi\Builders\Components\RequestBodiesBuilder;
use StoneHilt\OpenApi\Builders\Components\ResponsesBuilder;
use StoneHilt\OpenApi\Builders\Components\SchemasBuilder;
use StoneHilt\OpenApi\Builders\Components\SecuritySchemesBuilder;
use StoneHilt\OpenApi\Generator;

class ComponentsBuilder
{
    protected CallbacksBuilder $callbacksBuilder;
    protected RequestBodiesBuilder $requestBodiesBuilder;
    protected ResponsesBuilder $responsesBuilder;
    protected SchemasBuilder $schemasBuilder;
    protected SecuritySchemesBuilder $securitySchemesBuilder;

    public function __construct(
        CallbacksBuilder $callbacksBuilder,
        RequestBodiesBuilder $requestBodiesBuilder,
        ResponsesBuilder $responsesBuilder,
        SchemasBuilder $schemasBuilder,
        SecuritySchemesBuilder $securitySchemesBuilder
    ) {
        $this->callbacksBuilder = $callbacksBuilder;
        $this->requestBodiesBuilder = $requestBodiesBuilder;
        $this->responsesBuilder = $responsesBuilder;
        $this->schemasBuilder = $schemasBuilder;
        $this->securitySchemesBuilder = $securitySchemesBuilder;
    }

    public function build(
        string $collection = Generator::COLLECTION_DEFAULT,
        array $middlewares = []
    ): ?Components {
        $callbacks = $this->callbacksBuilder->build($collection);
        $requestBodies = $this->requestBodiesBuilder->build($collection);
        $responses = $this->responsesBuilder->build($collection);
        $schemas = $this->schemasBuilder->build($collection);
        $securitySchemes = $this->securitySchemesBuilder->build($collection);

        $components = Components::create();

        $hasAnyObjects = false;

        if (count($callbacks) > 0) {
            $hasAnyObjects = true;

            $components = $components->callbacks(...$callbacks);
        }

        if (count($requestBodies) > 0) {
            $hasAnyObjects = true;

            $components = $components->requestBodies(...$requestBodies);
        }

        if (count($responses) > 0) {
            $hasAnyObjects = true;
            $components = $components->responses(...$responses);
        }

        if (count($schemas) > 0) {
            $hasAnyObjects = true;
            $components = $components->schemas(...$schemas);
        }

        if (count($securitySchemes) > 0) {
            $hasAnyObjects = true;
            $components = $components->securitySchemes(...$securitySchemes);
        }

        if (! $hasAnyObjects) {
            return null;
        }

        foreach ($middlewares as $middleware) {
            app($middleware)->after($components);
        }

        return $components;
    }
}
