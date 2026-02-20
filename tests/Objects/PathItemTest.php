<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Operation;
use StoneHilt\OpenApi\Objects\Parameter;
use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\Objects\Server;
use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Tests\TestCase;

class PathItemTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $pathItem = PathItem::create()
            ->route('/users')
            ->summary('User endpoints')
            ->description('Get the users')
            ->operations(Operation::get())
            ->servers(Server::create()->url('https://goldspecdigital.com'))
            ->parameters(Parameter::create()->name('Test parameter'));

        $openApi = OpenApi::create()
            ->paths($pathItem);

        $this->assertEquals([
            'paths' => [
                '/users' => [
                    'summary' => 'User endpoints',
                    'description' => 'Get the users',
                    'get' => [],
                    'servers' => [
                        ['url' => 'https://goldspecdigital.com'],
                    ],
                    'parameters' => [
                        ['name' => 'Test parameter'],
                    ],
                ],
            ],
        ], $openApi->toArray());
    }
}
