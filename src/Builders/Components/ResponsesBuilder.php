<?php

namespace StoneHilt\OpenApi\Builders\Components;

use StoneHilt\OpenApi\Contracts\Reusable;
use StoneHilt\OpenApi\Factories\ResponseFactory;
use StoneHilt\OpenApi\Generator;

class ResponsesBuilder extends Builder
{
    public function build(string $collection = Generator::COLLECTION_DEFAULT): array
    {
        return $this->getAllClasses($collection)
            ->filter(static function ($class) {
                return
                    is_a($class, ResponseFactory::class, true) &&
                    is_a($class, Reusable::class, true);
            })
            ->map(static function ($class) {
                /** @var ResponseFactory $instance */
                $instance = app($class);

                return $instance->build();
            })
            ->values()
            ->toArray();
    }
}
