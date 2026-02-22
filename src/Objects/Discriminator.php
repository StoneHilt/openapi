<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Exceptions\InvalidArgumentException;
use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $propertyName
 * @property array|null $mapping
 */
class Discriminator extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $propertyName = null;

    /**
     * @var array|null
     */
    protected ?array $mapping = null;

    /**
     * @param string|null $propertyName
     * @return static
     */
    public function propertyName(?string $propertyName): static
    {
        $instance = clone $this;

        $instance->propertyName = $propertyName;

        return $instance;
    }

    /**
     * @param array $mapping
     * @throws InvalidArgumentException
     * @return static
     */
    public function mapping(array $mapping): static
    {
        // Ensure the mappings are string => string.
        foreach ($mapping as $key => $value) {
            if (is_string($key) && is_string($value)) {
                continue;
            }

            throw new InvalidArgumentException('Each mapping must have a string key and a string value.');
        }

        $instance = clone $this;

        $instance->mapping = $mapping ?: null;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'propertyName' => $this->propertyName,
            'mapping' => $this->mapping,
        ]);
    }
}
