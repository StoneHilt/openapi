<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Contracts\SchemaContract;
use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property Schema[]|null $schemas
 * @property Response[]|null $responses
 * @property Parameter[]|null $parameters
 * @property Example[]|null $examples
 * @property RequestBody[]|null $requestBodies
 * @property Header[]|null $headers
 * @property SecurityScheme[]|null $securitySchemes
 * @property Link[]|null $links
 */
class Components extends BaseObject
{
    /**
     * @var Schema[]|null
     */
    protected ?array $schemas = null;

    /**
     * @var Response[]|null
     */
    protected ?array $responses = null;

    /**
     * @var Parameter[]|null
     */
    protected ?array $parameters = null;

    /**
     * @var Example[]|null
     */
    protected ?array $examples = null;

    /**
     * @var RequestBody[]|null
     */
    protected ?array $requestBodies = null;

    /**
     * @var Header[]|null
     */
    protected ?array $headers = null;

    /**
     * @var SecurityScheme[]|null
     */
    protected ?array $securitySchemes = null;

    /**
     * @var Link[]|null
     */
    protected ?array $links = null;

    /**
     * @var PathItem[]|null
     */
    protected ?array $callbacks = null;

    /**
     * @param SchemaContract[] $schemas
     * @return static
     */
    public function schemas(SchemaContract ...$schemas): static
    {
        $instance = clone $this;

        $instance->schemas = $schemas ?: null;

        return $instance;
    }

    /**
     * @param Response[] $responses
     * @return static
     */
    public function responses(Response ...$responses): static
    {
        $instance = clone $this;

        $instance->responses = $responses ?: null;

        return $instance;
    }

    /**
     * @param Parameter[] $parameters
     * @return static
     */
    public function parameters(Parameter ...$parameters): static
    {
        $instance = clone $this;

        $instance->parameters = $parameters ?: null;

        return $instance;
    }

    /**
     * @param Example[] $examples
     * @return static
     */
    public function examples(Example ...$examples): static
    {
        $instance = clone $this;

        $instance->examples = $examples ?: null;

        return $instance;
    }

    /**
     * @param RequestBody[] $requestBodies
     * @return static
     */
    public function requestBodies(RequestBody ...$requestBodies): static
    {
        $instance = clone $this;

        $instance->requestBodies = $requestBodies ?: null;

        return $instance;
    }

    /**
     * @param Header[] $headers
     * @return static
     */
    public function headers(Header ...$headers): static
    {
        $instance = clone $this;

        $instance->headers = $headers ?: null;

        return $instance;
    }

    /**
     * @param SecurityScheme[] $securitySchemes
     * @return static
     */
    public function securitySchemes(SecurityScheme ...$securitySchemes): static
    {
        $instance = clone $this;

        $instance->securitySchemes = $securitySchemes ?: null;

        return $instance;
    }

    /**
     * @param Link[] $links
     * @return static
     */
    public function links(Link ...$links): static
    {
        $instance = clone $this;

        $instance->links = $links ?: null;

        return $instance;
    }

    /**
     * @param PathItem[] $callbacks
     * @return static
     */
    public function callbacks(PathItem ...$callbacks): static
    {
        $instance = clone $this;

        $instance->callbacks = $callbacks ?: null;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        $schemas = [];
        foreach ($this->schemas ?? [] as $schema) {
            $schemas[$schema->objectId] = $schema;
        }

        $responses = [];
        foreach ($this->responses ?? [] as $response) {
            $responses[$response->objectId] = $response;
        }

        $parameters = [];
        foreach ($this->parameters ?? [] as $parameter) {
            $parameters[$parameter->objectId] = $parameter;
        }

        $examples = [];
        foreach ($this->examples ?? [] as $example) {
            $examples[$example->objectId] = $example;
        }

        $requestBodies = [];
        foreach ($this->requestBodies ?? [] as $requestBodie) {
            $requestBodies[$requestBodie->objectId] = $requestBodie;
        }

        $headers = [];
        foreach ($this->headers ?? [] as $header) {
            $headers[$header->objectId] = $header;
        }

        $securitySchemes = [];
        foreach ($this->securitySchemes ?? [] as $securityScheme) {
            $securitySchemes[$securityScheme->objectId] = $securityScheme;
        }

        $links = [];
        foreach ($this->links ?? [] as $link) {
            $links[$link->objectId] = $link;
        }

        $callbacks = [];
        foreach ($this->callbacks ?? [] as $callback) {
            $callbacks[$callback->objectId][$callback->uri] = $callback;
        }

        return Arr::filter([
            'schemas' => $schemas ?: null,
            'responses' => $responses ?: null,
            'parameters' => $parameters ?: null,
            'examples' => $examples ?: null,
            'requestBodies' => $requestBodies ?: null,
            'headers' => $headers ?: null,
            'securitySchemes' => $securitySchemes ?: null,
            'links' => $links ?: null,
            'callbacks' => $callbacks ?: null,
        ]);
    }
}
