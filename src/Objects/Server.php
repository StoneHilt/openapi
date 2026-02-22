<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $url
 * @property string|null $description
 * @property ServerVariable[]|null $variables
 */
class Server extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var ServerVariable[]|null
     */
    protected ?array $variables = null;

    /**
     * @param string|null $url
     * @return static
     */
    public function url(?string $url): static
    {
        $instance = clone $this;

        $instance->url = $url;

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
     * @param ServerVariable[] $variables
     * @return static
     */
    public function variables(ServerVariable ...$variables): static
    {
        $instance = clone $this;

        $instance->variables = $variables ?: null;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        $variables = [];
        foreach ($this->variables ?? [] as $variable) {
            $variables[$variable->objectId] = $variable->toArray();
        }

        return Arr::filter([
            'url' => $this->url,
            'description' => $this->description,
            'variables' => $variables ?: null,
        ]);
    }
}
