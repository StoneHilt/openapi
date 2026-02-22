<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

class AnyOf extends SchemaComposition
{
    /**
     * @return string
     */
    protected function compositionType(): string
    {
        return 'anyOf';
    }
}
