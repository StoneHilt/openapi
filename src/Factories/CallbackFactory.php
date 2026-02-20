<?php

namespace StoneHilt\OpenApi\Factories;

use StoneHilt\OpenApi\Objects\PathItem;

abstract class CallbackFactory
{
    abstract public function build(): PathItem;
}
