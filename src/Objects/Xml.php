<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $name
 * @property string|null $namespace
 * @property string|null $prefix
 * @property bool|null $attribute
 * @property bool|null $wrapped
 */
class Xml extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $namespace = null;

    /**
     * @var string|null
     */
    protected ?string $prefix = null;

    /**
     * @var bool|null
     */
    protected ?bool $attribute = null;

    /**
     * @var bool|null
     */
    protected ?bool $wrapped = null;

    /**
     * @param string|null $name
     * @return static
     */
    public function name(?string $name): static
    {
        $instance = clone $this;

        $instance->name = $name;

        return $instance;
    }

    /**
     * @param string|null $namespace
     * @return static
     */
    public function namespace(?string $namespace): static
    {
        $instance = clone $this;

        $instance->namespace = $namespace;

        return $instance;
    }

    /**
     * @param string|null $prefix
     * @return static
     */
    public function prefix(?string $prefix): static
    {
        $instance = clone $this;

        $instance->prefix = $prefix;

        return $instance;
    }

    /**
     * @param bool|null $attribute
     * @return static
     */
    public function attribute(?bool $attribute = true): static
    {
        $instance = clone $this;

        $instance->attribute = $attribute;

        return $instance;
    }

    /**
     * @param bool|null $wrapped
     * @return static
     */
    public function wrapped(?bool $wrapped = true): static
    {
        $instance = clone $this;

        $instance->wrapped = $wrapped;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'name' => $this->name,
            'namespace' => $this->namespace,
            'prefix' => $this->prefix,
            'attribute' => $this->attribute,
            'wrapped' => $this->wrapped,
        ]);
    }
}
