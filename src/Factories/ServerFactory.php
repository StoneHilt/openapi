<?php

namespace StoneHilt\OpenApi\Factories;

use StoneHilt\OpenApi\Objects\Server;

abstract class ServerFactory
{
    abstract public function build(): Server;
}
