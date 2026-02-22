<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $type
 * @property string|null $description
 * @property string|null $name
 * @property string|null $in
 * @property string|null $scheme
 * @property string|null $bearerFormat
 * @property OAuthFlow[]|null $flows
 * @property string|null $openIdConnectUrl
 */
class SecurityScheme extends BaseObject
{
    const TYPE_API_KEY = 'apiKey';
    const TYPE_HTTP = 'http';
    const TYPE_OAUTH2 = 'oauth2';
    const TYPE_OPEN_ID_CONNECT = 'openIdConnect';

    const IN_QUERY = 'query';
    const IN_HEADER = 'header';
    const IN_COOKIE = 'cookie';

    /**
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $in = null;

    /**
     * @var string|null
     */
    protected ?string $scheme = null;

    /**
     * @var string|null
     */
    protected ?string $bearerFormat = null;

    /**
     * @var OAuthFlow[]|null
     */
    protected ?array $flows = null;

    /**
     * @var string|null
     */
    protected ?string $openIdConnectUrl = null;

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function oauth2(string $objectId = null): static
    {
        return static::create($objectId)->type(static::TYPE_OAUTH2);
    }

    /**
     * @param string|null $type
     * @return static
     */
    public function type(?string $type): static
    {
        $instance = clone $this;

        $instance->type = $type;

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
     * @param string|null $in
     * @return static
     */
    public function in(?string $in): static
    {
        $instance = clone $this;

        $instance->in = $in;

        return $instance;
    }

    /**
     * @param string|null $scheme
     * @return static
     */
    public function scheme(?string $scheme): static
    {
        $instance = clone $this;

        $instance->scheme = $scheme;

        return $instance;
    }

    /**
     * @param string|null $bearerFormat
     * @return static
     */
    public function bearerFormat(?string $bearerFormat): static
    {
        $instance = clone $this;

        $instance->bearerFormat = $bearerFormat;

        return $instance;
    }

    /**
     * @param OAuthFlow[] $flows
     * @return static
     */
    public function flows(OAuthFlow ...$flows): static
    {
        $instance = clone $this;

        $instance->flows = $flows;

        return $instance;
    }

    /**
     * @param string|null $openIdConnectUrl
     * @return static
     */
    public function openIdConnectUrl(?string $openIdConnectUrl): static
    {
        $instance = clone $this;

        $instance->openIdConnectUrl = $openIdConnectUrl;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        $flows = [];
        foreach ($this->flows ?? [] as $flow) {
            $flows[$flow->flow] = $flow;
        }

        return Arr::filter([
            'type' => $this->type,
            'description' => $this->description,
            'name' => $this->name,
            'in' => $this->in,
            'scheme' => $this->scheme,
            'bearerFormat' => $this->bearerFormat,
            'flows' => $flows ?: null,
            'openIdConnectUrl' => $this->openIdConnectUrl,
        ]);
    }
}
