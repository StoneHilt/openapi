<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

class OneOf extends SchemaComposition
{
    /**
     * @return string
     */
    protected function compositionType(): string
    {
        return 'oneOf';
    }
}
