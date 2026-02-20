<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\ExternalDocs;
use StoneHilt\OpenApi\Objects\Operation;
use StoneHilt\OpenApi\Objects\Parameter;
use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\Objects\RequestBody;
use StoneHilt\OpenApi\Objects\Response;
use StoneHilt\OpenApi\Objects\SecurityRequirement;
use StoneHilt\OpenApi\Objects\SecurityScheme;
use StoneHilt\OpenApi\Objects\Server;
use StoneHilt\OpenApi\Objects\Tag;
use StoneHilt\OpenApi\Tests\TestCase;

class OperationTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $securityScheme = SecurityScheme::create('OAuth2')
            ->type(SecurityScheme::TYPE_OAUTH2);

        $callback = PathItem::create('MyEvent')
            ->route('{$request.query.callbackUrl}')
            ->operations(
                Operation::post()->requestBody(
                    RequestBody::create()
                        ->description('something happened')
                )
            );

        $operation = Operation::create()
            ->action(Operation::ACTION_GET)
            ->tags(Tag::create()->name('Users'))
            ->summary('Lorem ipsum')
            ->description('Dolar sit amet')
            ->externalDocs(ExternalDocs::create())
            ->operationId('users.show')
            ->parameters(Parameter::create())
            ->requestBody(RequestBody::create())
            ->responses(Response::create())
            ->deprecated()
            ->security(SecurityRequirement::create()->securityScheme($securityScheme))
            ->servers(Server::create())
            ->callbacks($callback);

        $pathItem = PathItem::create()
            ->operations($operation);

        $this->assertEquals([
            'get' => [
                'tags' => ['Users'],
                'summary' => 'Lorem ipsum',
                'description' => 'Dolar sit amet',
                'externalDocs' => [],
                'operationId' => 'users.show',
                'parameters' => [
                    [],
                ],
                'requestBody' => [],
                'responses' => [
                    'default' => [],
                ],
                'deprecated' => true,
                'security' => [
                    [
                        'OAuth2' => [],
                    ],
                ],
                'servers' => [
                    [],
                ],
                'callbacks' => [
                    'MyEvent' => [
                        '{$request.query.callbackUrl}' => [
                            'post' => [
                                'requestBody' => [
                                    'description' => 'something happened',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], $pathItem->toArray());
    }

    /** @test */
    public function create_with_no_security_works()
    {
        $operation = Operation::get()
            ->noSecurity();

        $pathItem = PathItem::create()->operations($operation);

        $this->assertEquals([
            'get' => [
                'security' => [],
            ],
        ], $pathItem->toArray());
    }
}
