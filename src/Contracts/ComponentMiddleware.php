<?php

namespace StoneHilt\OpenApi\Contracts;

use StoneHilt\OpenApi\Objects\Components;

interface ComponentMiddleware
{
    public function after(Components $components): void;
}
