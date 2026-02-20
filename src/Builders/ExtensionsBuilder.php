<?php

namespace StoneHilt\OpenApi\Builders;

use StoneHilt\OpenApi\Objects\BaseObject;
use Illuminate\Support\Collection;
use StoneHilt\OpenApi\Attributes\Extension as ExtensionAttribute;
use StoneHilt\OpenApi\Factories\ExtensionFactory;

class ExtensionsBuilder
{
    public function build(BaseObject $object, Collection $attributes): void
    {
        $attributes
            ->filter(static fn (object $attribute) => $attribute instanceof ExtensionAttribute)
            ->each(static function (ExtensionAttribute $attribute) use ($object): void {
                if ($attribute->factory) {
                    /** @var ExtensionFactory $factory */
                    $factory = app($attribute->factory);
                    $key = $factory->key();
                    $value = $factory->value();
                } else {
                    $key = $attribute->key;
                    $value = $attribute->value;
                }

                $object->x(
                    $key,
                    $value
                );
            });
    }
}
