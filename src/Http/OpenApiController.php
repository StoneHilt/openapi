<?php

namespace StoneHilt\OpenApi\Http;

use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Generator;

class OpenApiController
{
    public function show(Generator $generator): OpenApi
    {
        return $generator->generate();
    }
}
