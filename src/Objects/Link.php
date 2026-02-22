<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $operationRef
 * @property string|null $operationId
 * @property string|null $description
 * @property Server|null $server
 */
class Link extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $operationRef = null;

    /**
     * @var string|null
     */
    protected ?string $operationId = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var Server|null
     */
    protected ?Server $server = null;

    /**
     * @param string|null $operationRef
     * @return static
     */
    public function operationRef(?string $operationRef): static
    {
        $instance = clone $this;

        $instance->operationRef = $operationRef;

        return $instance;
    }

    /**
     * @param string|null $operationId
     * @return static
     */
    public function operationId(?string $operationId): static
    {
        $instance = clone $this;

        $instance->operationId = $operationId;

        return $instance;
    }

    /**
     * @param string|null $description
     * @return static
     */
    public function description(?string $description): static
    {
        $instance = clone $this;

        $instance->description = $description;

        return $instance;
    }

    /**
     * @param Server|null $server
     * @return static
     */
    public function server(?Server $server): static
    {
        $instance = clone $this;

        $instance->server = $server;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'operationRef' => $this->operationRef,
            'operationId' => $this->operationId,
            'description' => $this->description,
            'server' => $this->server,
        ]);
    }
}
