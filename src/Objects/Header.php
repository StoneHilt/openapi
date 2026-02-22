<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Contracts\SchemaContract;
use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property string|null $description
 * @property bool|null $required
 * @property bool|null $deprecated
 * @property bool|null $allowEmptyValue
 * @property string|null $style
 * @property bool|null $explode
 * @property bool|null $allowReserved
 * @property Schema|null $schema
 * @property mixed|null $example
 * @property Example[]|null $examples
 * @property MediaType[]|null $content
 */
class Header extends BaseObject
{
    const STYLE_MATRIX = 'matrix';
    const STYLE_LABEL = 'label';
    const STYLE_FORM = 'form';
    const STYLE_SIMPLE = 'simple';
    const STYLE_SPACE_DELIMITED = 'spaceDelimited';
    const STYLE_PIPE_DELIMITED = 'pipeDelimited';
    const STYLE_DEEP_OBJECT = 'deepObject';

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var bool|null
     */
    protected ?bool $required = null;

    /**
     * @var bool|null
     */
    protected ?bool $deprecated = null;

    /**
     * @var bool|null
     */
    protected ?bool $allowEmptyValue = null;

    /**
     * @var string|null
     */
    protected ?string $style = null;

    /**
     * @var bool|null
     */
    protected ?bool $explode = null;

    /**
     * @var bool|null
     */
    protected ?bool $allowReserved = null;

    /**
     * @var Schema|null
     */
    protected ?SchemaContract $schema = null;

    /**
     * @var mixed|null
     */
    protected mixed $example = null;

    /**
     * @var Example[]|null
     */
    protected ?array $examples = null;

    /**
     * @var MediaType[]|null
     */
    protected ?array $content = null;

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
     * @param bool|null $required
     * @return static
     */
    public function required(?bool $required = true): static
    {
        $instance = clone $this;

        $instance->required = $required;

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
     * @param bool|null $allowEmptyValue
     * @return static
     */
    public function allowEmptyValue(?bool $allowEmptyValue = true): static
    {
        $instance = clone $this;

        $instance->allowEmptyValue = $allowEmptyValue;

        return $instance;
    }

    /**
     * @param string|null $style
     * @return static
     */
    public function style(?string $style): static
    {
        $instance = clone $this;

        $instance->style = $style;

        return $instance;
    }

    /**
     * @param bool|null $explode
     * @return static
     */
    public function explode(?bool $explode = true): static
    {
        $instance = clone $this;

        $instance->explode = $explode;

        return $instance;
    }

    /**
     * @param bool|null $allowReserved
     * @return static
     */
    public function allowReserved(?bool $allowReserved = true): static
    {
        $instance = clone $this;

        $instance->allowReserved = $allowReserved;

        return $instance;
    }

    /**
     * @param SchemaContract|null $schema
     * @return static
     */
    public function schema(?SchemaContract $schema): static
    {
        $instance = clone $this;

        $instance->schema = $schema;

        return $instance;
    }

    /**
     * @param mixed|null $example
     * @return static
     */
    public function example($example): static
    {
        $instance = clone $this;

        $instance->example = $example;

        return $instance;
    }

    /**
     * @param Example[] $examples
     * @return static
     */
    public function examples(Example ...$examples): static
    {
        $instance = clone $this;

        $instance->examples = $examples ?: null;

        return $instance;
    }

    /**
     * @param MediaType[] $content
     * @return static
     */
    public function content(MediaType ...$content): static
    {
        $instance = clone $this;

        $instance->content = $content ?: null;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        $examples = [];
        foreach ($this->examples ?? [] as $example) {
            $examples[$example->objectId] = $example->toArray();
        }

        $content = [];
        foreach ($this->content ?? [] as $contentItem) {
            $content[$contentItem->mediaType] = $contentItem;
        }

        return Arr::filter([
            'description' => $this->description,
            'required' => $this->required,
            'deprecated' => $this->deprecated,
            'allowEmptyValue' => $this->allowEmptyValue,
            'style' => $this->style,
            'explode' => $this->explode,
            'allowReserved' => $this->allowReserved,
            'schema' => $this->schema,
            'example' => $this->example,
            'examples' => $examples ?: null,
            'content' => $content ?: null,
        ]);
    }
}
