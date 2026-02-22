<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $name
 * @property string|null $url
 * @property string|null $email
 */
class Contact extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * @var string|null
     */
    protected ?string $email = null;

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
     * @param string|null $email
     * @return static
     */
    public function email(?string $email): static
    {
        $instance = clone $this;

        $instance->email = $email;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'name' => $this->name,
            'url' => $this->url,
            'email' => $this->email,
        ]);
    }
}
