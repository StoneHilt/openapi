<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\AnyOf;
use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

class AnyOfTest extends TestCase
{
    /** @test */
    public function two_schemas_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $anyOf = AnyOf::create()
            ->schemas($schema1, $schema2);

        $this->assertEquals([
            'anyOf' => [
                [
                    'type' => 'string',
                ],
                [
                    'type' => 'integer',
                ],
            ],
        ], $anyOf->toArray());
    }

    /** @test */
    public function two_schemas_as_response_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $anyOf = AnyOf::create()
            ->schemas($schema1, $schema2);

        $response = MediaType::json()
            ->schema($anyOf);

        $this->assertEquals([
            'schema' => [
                'anyOf' => [
                    [
                        'type' => 'string',
                    ],
                    [
                        'type' => 'integer',
                    ],
                ],
            ],
        ], $response->toArray());
    }
}
