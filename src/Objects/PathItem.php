<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $route
 * @property string|null $summary
 * @property string|null $description
 * @property \StoneHilt\OpenApi\Objects\Operation[]|null $operations
 * @property \StoneHilt\OpenApi\Objects\Server[]|null $servers
 * @property \StoneHilt\OpenApi\Objects\Parameter[]|null $parameters
 */
class PathItem extends BaseObject
{
    /**
     * @var string|null
     */
    protected $route;

    /**
     * @var string|null
     */
    protected ?string $summary = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var Operation[]|null
     */
    protected ?array $operations = null;

    /**
     * @var Server[]|null
     */
    protected ?array $servers = null;

    /**
     * @var Parameter[]|null
     */
    protected ?array $parameters = null;

    /**
     * @param string|null $route
     * @return static
     */
    public function route(?string $route): self
    {
        $instance = clone $this;

        $instance->route = $route;

        return $instance;
    }

    /**
     * @param string|null $summary
     * @return static
     */
    public function summary(?string $summary): static
    {
        $instance = clone $this;

        $instance->summary = $summary;

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
     * @param Operation[] $operations
     * @return static
     */
    public function operations(Operation ...$operations): static
    {
        $instance = clone $this;

        $instance->operations = $operations ?: null;

        return $instance;
    }

    /**
     * @param Server[] $servers
     * @return static
     */
    public function servers(Server ...$servers): static
    {
        $instance = clone $this;

        $instance->servers = $servers ?: null;

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
     * @return array
     */
    protected function generate(): array
    {
        $operations = [];
        foreach ($this->operations ?? [] as $operation) {
            $operations[$operation->action] = $operation->toArray();
        }

        return Arr::filter(
            array_merge($operations, [
                'summary' => $this->summary,
                'description' => $this->description,
                'servers' => $this->servers,
                'parameters' => $this->parameters,
            ])
        );
    }
}
