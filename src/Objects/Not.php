<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

use StoneHilt\OpenApi\Contracts\SchemaContract;
use StoneHilt\OpenApi\Utilities\Arr;

/**
 * @property Schema|null $schema
 */
class Not extends BaseObject implements SchemaContract
{
    /**
     * @var SchemaContract|null
     */
    protected ?SchemaContract $schema = null;

    /**
     * @param Schema|null $schema
     * @return static
     */
    public function schema(?Schema $schema): static
    {
        $instance = clone $this;

        $instance->schema = $schema;

        return $instance;
    }

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            'not' => $this->schema,
        ]);
    }
}
