<?php

namespace StoneHilt\OpenApi;

use StoneHilt\OpenApi\Objects\Schema;
use ReflectionType;

class SchemaHelpers
{
    public static function guessFromReflectionType(ReflectionType $reflectionType): Schema
    {
        switch ($reflectionType->getName()) {
            case 'int':
                return Schema::integer();
            case 'bool':
                return Schema::boolean();
        }

        return Schema::string();
    }
}
