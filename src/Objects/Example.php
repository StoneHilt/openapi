<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $summary
 * @property string|null $description
 * @property mixed|null $value
 * @property string|null $externalValue
 */
class Example extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $summary = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var mixed|null
     */
    protected mixed $value = null;

    /**
     * @var string|null
     */
    protected ?string $externalValue = null;

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
     * @param mixed|null $value
     * @return static
     */
    public function value($value): static
    {
        $instance = clone $this;

        $instance->value = $value;

        return $instance;
    }

    /**
     * @param string|null $externalValue
     * @return static
     */
    public function externalValue(?string $externalValue): static
    {
        $instance = clone $this;

        $instance->externalValue = $externalValue;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'summary' => $this->summary,
            'description' => $this->description,
            'value' => $this->value,
            'externalValue' => $this->externalValue,
        ]);
    }
}
