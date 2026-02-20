<?php

namespace StoneHilt\OpenApi\Factories;

use StoneHilt\OpenApi\Contracts\SchemaContract;
use StoneHilt\OpenApi\Objects\AllOf;
use StoneHilt\OpenApi\Objects\AnyOf;
use StoneHilt\OpenApi\Objects\Not;
use StoneHilt\OpenApi\Objects\OneOf;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Concerns\Referencable;

abstract class SchemaFactory
{
    use Referencable;

    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    abstract public function build(): SchemaContract;
}
