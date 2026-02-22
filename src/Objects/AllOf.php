<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Objects;

class AllOf extends SchemaComposition
{
    /**
     * @return string
     */
    protected function compositionType(): string
    {
        return 'allOf';
    }
}
