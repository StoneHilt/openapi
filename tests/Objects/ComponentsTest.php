<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Components;
use StoneHilt\OpenApi\Objects\Example;
use StoneHilt\OpenApi\Objects\Header;
use StoneHilt\OpenApi\Objects\Link;
use StoneHilt\OpenApi\Objects\OAuthFlow;
use StoneHilt\OpenApi\Objects\Operation;
use StoneHilt\OpenApi\Objects\Parameter;
use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\Objects\RequestBody;
use StoneHilt\OpenApi\Objects\Response;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Objects\SecurityScheme;
use StoneHilt\OpenApi\Tests\TestCase;

class ComponentsTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $schema = Schema::object('ExampleSchema');

        $response = Response::created('ResourceCreated');

        $parameter = Parameter::query('Page')
            ->name('page');

        $example = Example::create('PageExample')
            ->value(5);

        $requestBody = RequestBody::create('CreateResource');

        $header = Header::create('HeaderExample');

        $oauthFlow = OAuthFlow::create()
            ->flow(OAuthFlow::FLOW_IMPLICIT)
            ->authorizationUrl('http://example.org/api/oauth/dialog');

        $securityScheme = SecurityScheme::create('OAuth2')
            ->type(SecurityScheme::TYPE_OAUTH2)
            ->flows($oauthFlow);

        $link = Link::create('LinkExample');

        $callback = PathItem::create('MyEvent')
            ->route('{$request.query.callbackUrl}')
            ->operations(
                Operation::post()->requestBody(
                    RequestBody::create()
                        ->description('something happened')
                )
            );

        $components = Components::create()
            ->schemas($schema)
            ->responses($response)
            ->parameters($parameter)
            ->examples($example)
            ->requestBodies($requestBody)
            ->headers($header)
            ->securitySchemes($securityScheme)
            ->links($link)
            ->callbacks($callback);

        $this->assertEquals([
            'schemas' => [
                'ExampleSchema' => [
                    'type' => 'object',
                ],
            ],
            'responses' => [
                'ResourceCreated' => [
                    'description' => 'Created',
                ],
            ],
            'parameters' => [
                'Page' => [
                    'name' => 'page',
                    'in' => 'query',
                ],
            ],
            'examples' => [
                'PageExample' => [
                    'value' => 5,
                ],
            ],
            'requestBodies' => [
                'CreateResource' => [],
            ],
            'headers' => [
                'HeaderExample' => [],
            ],
            'securitySchemes' => [
                'OAuth2' => [
                    'type' => 'oauth2',
                    'flows' => [
                        'implicit' => [
                            'authorizationUrl' => 'http://example.org/api/oauth/dialog',
                        ],
                    ],
                ],
            ],
            'links' => [
                'LinkExample' => [],
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
        ], $components->toArray());
    }
}
