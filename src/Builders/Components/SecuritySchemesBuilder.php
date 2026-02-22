<?php

namespace StoneHilt\OpenApi\Builders\Components;

use StoneHilt\OpenApi\Factories\SecuritySchemeFactory;
use StoneHilt\OpenApi\Generator;

class SecuritySchemesBuilder extends Builder
{
    public function build(string $collection = Generator::COLLECTION_DEFAULT): array
    {
        return $this->getAllClasses($collection)
            ->filter(static function ($class) {
                return is_a($class, SecuritySchemeFactory::class, true);
            })
            ->map(static function ($class) {
                /** @var SecuritySchemeFactory $instance */
                $instance = app($class);

                return $instance->build();
            })
            ->values()
            ->toArray();
    }
}
