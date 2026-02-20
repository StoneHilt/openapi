<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Server;
use StoneHilt\OpenApi\Objects\ServerVariable;
use StoneHilt\OpenApi\Tests\TestCase;

class ServerVariableTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $serverVariable = ServerVariable::create('ServerVariableName')
            ->enum('Earth', 'Mars', 'Saturn')
            ->default('Earth')
            ->description('The planet the server is running on');

        $server = Server::create()
            ->variables($serverVariable);

        $this->assertEquals([
            'variables' => [
                'ServerVariableName' => [
                    'enum' => ['Earth', 'Mars', 'Saturn'],
                    'default' => 'Earth',
                    'description' => 'The planet the server is running on',
                ],
            ],
        ], $server->toArray());
    }
}
