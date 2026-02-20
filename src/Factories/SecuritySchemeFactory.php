<?php

namespace StoneHilt\OpenApi\Factories;

use StoneHilt\OpenApi\Objects\SecurityScheme;

abstract class SecuritySchemeFactory
{
    abstract public function build(): SecurityScheme;
}
