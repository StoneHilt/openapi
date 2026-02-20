<?php

namespace StoneHilt\OpenApi\Factories;

use StoneHilt\OpenApi\Objects\Parameter;
use StoneHilt\OpenApi\Concerns\Referencable;

abstract class ParametersFactory
{
    use Referencable;

    /**
     * @return Parameter[]
     */
    abstract public function build(): array;
}
