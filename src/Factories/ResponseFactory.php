<?php

namespace StoneHilt\OpenApi\Factories;

use StoneHilt\OpenApi\Objects\Response;
use StoneHilt\OpenApi\Concerns\Referencable;

abstract class ResponseFactory
{
    use Referencable;

    abstract public function build(): Response;
}
