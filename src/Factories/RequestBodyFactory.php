<?php

namespace StoneHilt\OpenApi\Factories;

use StoneHilt\OpenApi\Objects\RequestBody;
use StoneHilt\OpenApi\Concerns\Referencable;

abstract class RequestBodyFactory
{
    use Referencable;

    abstract public function build(): RequestBody;
}
