<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Example;
use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $example = Example::create()
            ->summary('Summary ipsum')
            ->description('Description ipsum')
            ->value('Value')
            ->externalValue('https://goldspecdigital.com/example.json');

        $mediaType = MediaType::json()
            ->example($example);

        $this->assertEquals([
            'example' => [
                'summary' => 'Summary ipsum',
                'description' => 'Description ipsum',
                'value' => 'Value',
                'externalValue' => 'https://goldspecdigital.com/example.json',
            ],
        ], $mediaType->toArray());
    }
}
