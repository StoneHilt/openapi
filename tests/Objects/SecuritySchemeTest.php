<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Components;
use StoneHilt\OpenApi\Objects\OAuthFlow;
use StoneHilt\OpenApi\Objects\SecurityScheme;
use StoneHilt\OpenApi\Tests\TestCase;

class SecuritySchemeTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $oauthFlow = OAuthFlow::create()
            ->flow(OAuthFlow::FLOW_CLIENT_CREDENTIALS);

        $securityScheme = SecurityScheme::create('OAuth2')
            ->type(SecurityScheme::TYPE_OAUTH2)
            ->description('Standard auth')
            ->in(SecurityScheme::IN_HEADER)
            ->scheme('basic')
            ->bearerFormat('JWT')
            ->flows($oauthFlow)
            ->openIdConnectUrl('https://goldspecdigital.com');

        $components = Components::create()
            ->securitySchemes($securityScheme);

        $this->assertEquals([
            'securitySchemes' => [
                'OAuth2' => [
                    'type' => 'oauth2',
                    'description' => 'Standard auth',
                    'in' => 'header',
                    'scheme' => 'basic',
                    'bearerFormat' => 'JWT',
                    'flows' => [
                        'clientCredentials' => [],
                    ],
                    'openIdConnectUrl' => 'https://goldspecdigital.com',
                ],
            ],
        ], $components->toArray());
    }
}
