<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Objects\Operation;
use StoneHilt\OpenApi\Objects\RequestBody;
use StoneHilt\OpenApi\Tests\TestCase;

class RequestBodyTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $requestBody = RequestBody::create()
            ->description('Standard request')
            ->content(MediaType::json())
            ->required();

        $operation = Operation::create()
            ->requestBody($requestBody);

        $this->assertEquals([
            'requestBody' => [
                'description' => 'Standard request',
                'content' => [
                    'application/json' => [],
                ],
                'required' => true,
            ],
        ], $operation->toArray());
    }
}
