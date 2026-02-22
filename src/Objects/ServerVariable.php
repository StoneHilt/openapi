<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string[]|null $enum
 * @property string|null $default
 * @property string|null $description
 */
class ServerVariable extends BaseObject
{
    /**
     * @var string[]|null
     */
    protected ?array $enum = null;

    /**
     * @var string|null
     */
    protected ?string $default = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @param string[] $enum
     * @return static
     */
    public function enum(string ...$enum): static
    {
        $instance = clone $this;

        $instance->enum = $enum ?: null;

        return $instance;
    }

    /**
     * @param string|null $default
     * @return static
     */
    public function default(?string $default): static
    {
        $instance = clone $this;

        $instance->default = $default;

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
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'enum' => $this->enum,
            'default' => $this->default,
            'description' => $this->description,
        ]);
    }
}
