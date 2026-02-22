<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Exceptions\InvalidArgumentException;
use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $securityScheme
 * @property string[]|null $scopes
 */
class SecurityRequirement extends BaseObject
{
    /**
     * @var string|null
     */
    protected ?string $securityScheme = null;

    /**
     * @var string[]|null
     */
    protected ?array $scopes = null;

    /**
     * @param \StoneHilt\OpenApi\Objects\SecurityScheme|string|null $securityScheme
     * @throws \StoneHilt\OpenApi\Exceptions\InvalidArgumentException
     * @return static
     */
    public function securityScheme($securityScheme): static
    {
        // If a SecurityScheme instance passed in, then use its Object ID.
        if ($securityScheme instanceof SecurityScheme) {
            $securityScheme = $securityScheme->objectId;
        }

        // If the $securityScheme is not a string or null then thrown an exception.
        if (!is_string($securityScheme) && !is_null($securityScheme)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The security scheme must either be an instance of [%s], a string or null.',
                    SecurityScheme::class
                )
            );
        }

        $instance = clone $this;

        $instance->securityScheme = $securityScheme;

        return $instance;
    }

    /**
     * @param string[] $scopes
     * @return static
     */
    public function scopes(string ...$scopes): static
    {
        $instance = clone $this;

        $instance->scopes = $scopes ?: null;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            $this->securityScheme => $this->scopes ?? [],
        ]);
    }
}
