<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi;

use StoneHilt\OpenApi\Exceptions\ValidationException;
use StoneHilt\OpenApi\Objects\BaseObject;
use StoneHilt\OpenApi\Objects\Components;
use StoneHilt\OpenApi\Objects\ExternalDocs;
use StoneHilt\OpenApi\Objects\Info;
use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\Objects\SecurityRequirement;
use StoneHilt\OpenApi\Objects\Server;
use StoneHilt\OpenApi\Objects\Tag;
use StoneHilt\OpenApi\Utilities\Arr;
use JsonSchema\Constraints\BaseConstraint;
use JsonSchema\Validator;

/**
 * @property string|null $openapi
 * @property Info|null $info
 * @property Server[]|null $servers
 * @property PathItem[]|null $paths
 * @property Components|null $components
 * @property \StoneHilt\OpenApi\Objects\SecurityRequirement[]|null $security
 * @property \StoneHilt\OpenApi\Objects\Tag[]|null $tags
 * @property \StoneHilt\OpenApi\Objects\ExternalDocs|null $externalDocs
 */
class OpenApi extends BaseObject
{
    const OPENAPI_3_0_0 = '3.0.0';
    const OPENAPI_3_0_1 = '3.0.1';
    const OPENAPI_3_0_2 = '3.0.2';

    /**
     * @var string|null
     */
    protected $openapi;

    /**
     * @var Info|null
     */
    protected $info;

    /**
     * @var Server[]|null
     */
    protected $servers;

    /**
     * @var PathItem[]|null
     */
    protected $paths;

    /**
     * @var Components|null
     */
    protected $components;

    /**
     * @var \StoneHilt\OpenApi\Objects\SecurityRequirement[]|null
     */
    protected $security;

    /**
     * @var \StoneHilt\OpenApi\Objects\Tag[]|null
     */
    protected $tags;

    /**
     * @var \StoneHilt\OpenApi\Objects\ExternalDocs|null
     */
    protected $externalDocs;

    /**
     * @param string|null $openapi
     * @return static
     */
    public function openapi(?string $openapi): self
    {
        $instance = clone $this;

        $instance->openapi = $openapi;

        return $instance;
    }

    /**
     * @param Info|null $info
     * @return static
     */
    public function info(?Info $info): self
    {
        $instance = clone $this;

        $instance->info = $info;

        return $instance;
    }

    /**
     * @param Server[] $servers
     * @return static
     */
    public function servers(Server ...$servers): self
    {
        $instance = clone $this;

        $instance->servers = $servers ?: null;

        return $instance;
    }

    /**
     * @param PathItem[] $paths
     * @return static
     */
    public function paths(PathItem ...$paths): self
    {
        $instance = clone $this;

        $instance->paths = $paths ?: null;

        return $instance;
    }

    /**
     * @param Components|null $components
     * @return static
     */
    public function components(?Components $components): self
    {
        $instance = clone $this;

        $instance->components = $components;

        return $instance;
    }

    /**
     * @param \StoneHilt\OpenApi\Objects\SecurityRequirement[] $security
     * @return static
     */
    public function security(SecurityRequirement ...$security): self
    {
        $instance = clone $this;

        $instance->security = $security ?: null;

        return $instance;
    }

    /**
     * @param \StoneHilt\OpenApi\Objects\Tag[] $tags
     * @return static
     */
    public function tags(Tag ...$tags): self
    {
        $instance = clone $this;

        $instance->tags = $tags ?: null;

        return $instance;
    }

    /**
     * @param \StoneHilt\OpenApi\Objects\ExternalDocs|null $externalDocs
     * @return static
     */
    public function externalDocs(?ExternalDocs $externalDocs): self
    {
        $instance = clone $this;

        $instance->externalDocs = $externalDocs;

        return $instance;
    }

    /**
     * @throws \StoneHilt\OpenApi\Exceptions\ValidationException
     */
    public function validate(): void
    {
        if (!class_exists('JsonSchema\Validator')) {
            throw new \RuntimeException('justinrainbow/json-schema should be installed for validation');
        }

        $data = BaseConstraint::arrayToObjectRecursive($this->generate());

        $schema = file_get_contents(
            realpath(__DIR__ . '/../schemas/v3.0.json')
        );
        $schema = json_decode($schema);

        $validator = new Validator();
        $validator->validate($data, $schema);

        if (!$validator->isValid()) {
            throw new ValidationException($validator->getErrors());
        }
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        $paths = [];
        foreach ($this->paths ?? [] as $path) {
            $paths[$path->uri] = $path;
        }

        return Arr::filter([
            'openapi' => $this->openapi,
            'info' => $this->info,
            'servers' => $this->servers,
            'paths' => $paths ?: null,
            'components' => $this->components,
            'security' => $this->security,
            'tags' => $this->tags,
            'externalDocs' => $this->externalDocs,
        ]);
    }
}
