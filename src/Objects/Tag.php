<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $name
 * @property string|null $description
 * @property ExternalDocs|null $externalDocs
 */
class Tag extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var ExternalDocs|null
     */
    protected ?ExternalDocs $externalDocs = null;

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
     * @param ExternalDocs|null $externalDocs
     * @return static
     */
    public function externalDocs(?ExternalDocs $externalDocs): static
    {
        $instance = clone $this;

        $instance->externalDocs = $externalDocs;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'name' => $this->name,
            'description' => $this->description,
            'externalDocs' => $this->externalDocs,
        ]);
    }
}
