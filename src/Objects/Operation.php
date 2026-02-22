<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Exceptions\InvalidArgumentException;
use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $action
 * @property string[]|null $tags
 * @property string|null $summary
 * @property string|null $description
 * @property ExternalDocs|null $externalDocs
 * @property string|null $operationId
 * @property Parameter[]|null $parameters
 * @property RequestBody|null $requestBody
 * @property Response[]|null $responses
 * @property bool|null $deprecated
 * @property SecurityRequirement[]|null $security
 * @property bool|null $noSecurity
 * @property Server[]|null $servers
 */
class Operation extends BaseObject
{
    const ACTION_GET = 'get';
    const ACTION_PUT = 'put';
    const ACTION_POST = 'post';
    const ACTION_DELETE = 'delete';
    const ACTION_OPTIONS = 'options';
    const ACTION_HEAD = 'head';
    const ACTION_PATCH = 'patch';
    const ACTION_TRACE = 'trace';

    /**
     * @var string|null
     */
    protected ?string $action = null;

    /**
     * @var string[]|null
     */
    protected ?array $tags = null;

    /**
     * @var string|null
     */
    protected ?string $summary = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var ExternalDocs|null
     */
    protected ?ExternalDocs $externalDocs = null;

    /**
     * @var string|null
     */
    protected ?string $operationId = null;

    /**
     * @var Parameter[]|null
     */
    protected ?array $parameters = null;

    /**
     * @var RequestBody|null
     */
    protected ?RequestBody $requestBody = null;

    /**
     * @var Response[]|null
     */
    protected ?array $responses = null;

    /**
     * @var bool|null
     */
    protected ?bool $deprecated = null;

    /**
     * @var SecurityRequirement[]|null
     */
    protected ?array $security = null;

    /**
     * @var bool|null
     */
    protected ?bool $noSecurity = null;

    /**
     * @var Server[]|null
     */
    protected ?array $servers = null;

    /**
     * @var PathItem[]|null
     */
    protected ?array $callbacks = null;

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function get(?string $objectId = null): static
    {
        return static::create($objectId)->action(static::ACTION_GET);
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function put(?string $objectId = null): static
    {
        return static::create($objectId)->action(static::ACTION_PUT);
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function post(?string $objectId = null): static
    {
        return static::create($objectId)->action(static::ACTION_POST);
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function delete(?string $objectId = null): static
    {
        return static::create($objectId)->action(static::ACTION_DELETE);
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function head(?string $objectId = null): static
    {
        return static::create($objectId)->action(static::ACTION_HEAD);
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function patch(?string $objectId = null): static
    {
        return static::create($objectId)->action(static::ACTION_PATCH);
    }

    /**
     * @param string|null $objectId
     * @return static
     */
    public static function trace(?string $objectId = null): static
    {
        return static::create($objectId)->action(static::ACTION_TRACE);
    }

    /**
     * @param string|null $action
     * @return static
     */
    public function action(?string $action): static
    {
        $instance = clone $this;

        $instance->action = $action;

        return $instance;
    }

    /**
     * @param Tag[]|string[] $tags
     * @throws InvalidArgumentException
     * @return static
     */
    public function tags(...$tags): static
    {
        // Only allow Tag instances and strings.
        foreach ($tags as &$tag) {
            // If a Tag instance was passed in then extract it's name string.
            if ($tag instanceof Tag) {
                $tag = $tag->name;
                continue;
            }

            if (is_string($tag)) {
                continue;
            }

            throw new InvalidArgumentException(
                sprintf(
                    'The tags must either be a string or an instance of [%s].',
                    Tag::class
                )
            );
        }

        $instance = clone $this;

        $instance->tags = $tags ?: null;

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
     * @param string|null $operationId
     * @return static
     */
    public function operationId(?string $operationId): static
    {
        $instance = clone $this;

        $instance->operationId = $operationId;

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
     * @param RequestBody|null $requestBody
     * @return static
     */
    public function requestBody(?RequestBody $requestBody): static
    {
        $instance = clone $this;

        $instance->requestBody = $requestBody;

        return $instance;
    }

    /**
     * @param Response[] $responses
     * @return static
     */
    public function responses(Response ...$responses): static
    {
        $instance = clone $this;

        $instance->responses = $responses;

        return $instance;
    }

    /**
     * @param bool|null $deprecated
     * @return static
     */
    public function deprecated(?bool $deprecated = true): static
    {
        $instance = clone $this;

        $instance->deprecated = $deprecated;

        return $instance;
    }

    /**
     * @param SecurityRequirement[]|null $security
     * @return static
     */
    public function security(SecurityRequirement ...$security): static
    {
        $instance = clone $this;

        $instance->security = $security ?: null;
        $instance->noSecurity = null;

        return $instance;
    }

    /**
     * @param bool|null $noSecurity
     * @return static
     */
    public function noSecurity(?bool $noSecurity = true): static
    {
        $instance = clone $this;

        $instance->noSecurity = $noSecurity;

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
     * @param PathItem[] $callbacks
     * @return $this
     */
    public function callbacks(PathItem ...$callbacks): static
    {
        $instance = clone $this;

        $instance->callbacks = $callbacks ?: null;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        $responses = [];
        foreach ($this->responses ?? [] as $response) {
            $responses[$response->statusCode ?? 'default'] = $response;
        }

        $callbacks = [];
        foreach ($this->callbacks ?? [] as $callback) {
            $callbacks[$callback->objectId][$callback->uri] = $callback;
        }

        return Arr::filter([
            'tags' => $this->tags,
            'summary' => $this->summary,
            'description' => $this->description,
            'externalDocs' => $this->externalDocs,
            'operationId' => $this->operationId,
            'parameters' => $this->parameters,
            'requestBody' => $this->requestBody,
            'responses' => $responses ?: null,
            'deprecated' => $this->deprecated,
            'security' => $this->noSecurity ? [] : $this->security,
            'servers' => $this->servers,
            'callbacks' => $callbacks ?: null,
        ]);
    }
}
