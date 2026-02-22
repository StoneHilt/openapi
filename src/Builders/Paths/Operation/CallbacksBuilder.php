<?php

namespace StoneHilt\OpenApi\Builders\Paths\Operation;

use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\Attributes\Callback as CallbackAttribute;
use StoneHilt\OpenApi\Contracts\Reusable;
use StoneHilt\OpenApi\RouteInformation;

class CallbacksBuilder
{
    public function build(RouteInformation $route): array
    {
        return $route->actionAttributes
            ->filter(static fn (object $attribute) => $attribute instanceof CallbackAttribute)
            ->map(static function (CallbackAttribute $attribute) {
                $factory = app($attribute->factory);
                $pathItem = $factory->build();

                if ($factory instanceof Reusable) {
                    return PathItem::ref('#/components/callbacks/'.$pathItem->objectId);
                }

                return $pathItem;
            })
            ->values()
            ->toArray();
    }
}
