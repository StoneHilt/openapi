<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Encoding;
use StoneHilt\OpenApi\Objects\Example;
use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Objects\Response;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

class MediaTypeTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $mediaType = MediaType::create()
            ->mediaType(MediaType::MEDIA_TYPE_APPLICATION_JSON)
            ->schema(Schema::object())
            ->examples(Example::create('ExampleName'))
            ->example(Example::create())
            ->encoding(Encoding::create('EncodingName'));

        $response = Response::create()
            ->content($mediaType);

        $this->assertEquals([
            'content' => [
                'application/json' => [
                    'schema' => [
                        'type' => 'object',
                    ],
                    'examples' => [
                        'ExampleName' => [],
                    ],
                    'example' => [],
                    'encoding' => [
                        'EncodingName' => [],
                    ],
                ],
            ],
        ], $response->toArray());
    }

    /** @test */
    public function create_example_with_ref_Works()
    {
        $mediaType = MediaType::create()
            ->mediaType(MediaType::MEDIA_TYPE_APPLICATION_JSON)
            ->examples(
                Example::ref('#/components/examples/FrogExample', 'frog')
            );

        $this->assertEquals([
            'examples' => [
                'frog' => [
                    '$ref' => '#/components/examples/FrogExample',
                ],
            ],
        ], $mediaType->toArray());
    }
}
