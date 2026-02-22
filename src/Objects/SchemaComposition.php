<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Contracts\SchemaContract;
use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property Schema[]|null $schemas
 */
abstract class SchemaComposition extends BaseObject implements SchemaContract
{
    /**
     * @var Schema[]|null
     */
    protected ?array $schemas = null;

    /**
     * @param Schema[] $schemas
     * @return static
     */
    public function schemas(Schema ...$schemas): static
    {
        $instance = clone $this;

        $instance->schemas = $schemas ?: null;

        return $instance;
    }

    /**
     * @return string
     */
    abstract protected function compositionType(): string;

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            $this->compositionType() => $this->schemas,
        ]);
    }
}
