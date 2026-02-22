<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Example;
use StoneHilt\OpenApi\Objects\Header;
use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Objects\Response;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

class HeaderTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $header = Header::create('HeaderName')
            ->description('Lorem ipsum')
            ->required()
            ->deprecated()
            ->allowEmptyValue()
            ->style(Header::STYLE_SIMPLE)
            ->explode()
            ->allowReserved()
            ->schema(Schema::object())
            ->example('Example value')
            ->examples(Example::create('ExampleName'))
            ->content(MediaType::json());

        $response = Response::create()
            ->headers($header);

        $this->assertEquals([
            'headers' => [
                'HeaderName' => [
                    'description' => 'Lorem ipsum',
                    'required' => true,
                    'deprecated' => true,
                    'allowEmptyValue' => true,
                    'style' => 'simple',
                    'explode' => true,
                    'allowReserved' => true,
                    'schema' => [
                        'type' => 'object',
                    ],
                    'example' => 'Example value',
                    'examples' => [
                        'ExampleName' => [],
                    ],
                    'content' => [
                        'application/json' => [],
                    ],
                ],
            ],
        ], $response->toArray());
    }
}
