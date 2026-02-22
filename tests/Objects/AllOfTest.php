<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\AllOf;
use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

class AllOfTest extends TestCase
{
    /** @test */
    public function two_schemas_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $allOf = AllOf::create()
            ->schemas($schema1, $schema2);

        $this->assertEquals([
            'allOf' => [
                [
                    'type' => 'string',
                ],
                [
                    'type' => 'integer',
                ],
            ],
        ], $allOf->toArray());
    }

    /** @test */
    public function two_schemas_as_response_work()
    {
        $schema1 = Schema::string();
        $schema2 = Schema::integer();

        $allOf = AllOf::create()
            ->schemas($schema1, $schema2);

        $response = MediaType::json()
            ->schema($allOf);

        $this->assertEquals([
            'schema' => [
                'allOf' => [
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
