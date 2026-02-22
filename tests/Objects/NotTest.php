<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Objects\Not;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

class NotTest extends TestCase
{
    /** @test */
    public function as_response_work()
    {
        $not = Not::create()
            ->schema(Schema::string());

        $response = MediaType::json()
            ->schema($not);

        $this->assertEquals([
            'schema' => [
                'not' => [
                    'type' => 'string',
                ],
            ],
        ], $response->toArray());
    }
}
