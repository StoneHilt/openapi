<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Example;
use StoneHilt\OpenApi\Objects\MediaType;
use StoneHilt\OpenApi\Objects\Operation;
use StoneHilt\OpenApi\Objects\Parameter;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

class ParameterTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $parameter = Parameter::create()
            ->name('user')
            ->in(Parameter::IN_PATH)
            ->description('User ID')
            ->required()
            ->deprecated()
            ->allowEmptyValue()
            ->style(Parameter::STYLE_SIMPLE)
            ->explode()
            ->allowReserved()
            ->schema(Schema::string())
            ->example(Example::create())
            ->examples(Example::create('ExampleName'))
            ->content(MediaType::json());

        $operation = Operation::create()
            ->parameters($parameter);

        $this->assertEquals([
            'parameters' => [
                [
                    'name' => 'user',
                    'in' => 'path',
                    'description' => 'User ID',
                    'required' => true,
                    'deprecated' => true,
                    'allowEmptyValue' => true,
                    'style' => 'simple',
                    'explode' => true,
                    'allowReserved' => true,
                    'schema' => ['type' => 'string'],
                    'example' => [],
                    'examples' => [
                        'ExampleName' => [],
                    ],
                    'content' => [
                        'application/json' => [],
                    ],
                ],
            ],
        ], $operation->toArray());
    }
}
