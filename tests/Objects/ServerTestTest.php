<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Server;
use StoneHilt\OpenApi\Objects\ServerVariable;
use StoneHilt\OpenApi\Tests\TestCase;

class ServerTestTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $serverVariable = ServerVariable::create('ServerVariableName')
            ->default('Default value');

        $server = Server::create()
            ->url('https://api.example.con/v1')
            ->description('Core API')
            ->variables($serverVariable);

        $this->assertEquals([
            'url' => 'https://api.example.con/v1',
            'description' => 'Core API',
            'variables' => [
                'ServerVariableName' => [
                    'default' => 'Default value',
                ],
            ],
        ], $server->toArray());
    }

    /** @test */
    public function variables_are_supported()
    {
        $serverVariable = ServerVariable::create('username')
            ->default('demo');

        $server = Server::create()
            ->url('https://api.example.con/v1')
            ->variables($serverVariable);

        $this->assertEquals(
            [
                'url' => 'https://api.example.con/v1',
                'variables' => [
                    'username' => [
                        'default' => 'demo',
                    ],
                ],
            ],
            $server->toArray()
        );
    }
}
