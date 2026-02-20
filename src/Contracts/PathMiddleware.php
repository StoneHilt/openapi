<?php

namespace StoneHilt\OpenApi\Contracts;

use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\RouteInformation;

interface PathMiddleware
{
    public function before(RouteInformation $routeInformation): void;

    public function after(PathItem $pathItem): PathItem;
}
