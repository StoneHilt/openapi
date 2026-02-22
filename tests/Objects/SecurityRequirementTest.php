<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\OAuthFlow;
use StoneHilt\OpenApi\Objects\SecurityRequirement;
use StoneHilt\OpenApi\Objects\SecurityScheme;
use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Tests\TestCase;

class SecurityRequirementTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $oauthFlow = OAuthFlow::create()
            ->flow(OAuthFlow::FLOW_CLIENT_CREDENTIALS)
            ->scopes(['read:user' => 'Access all user info']);

        $securityScheme = SecurityScheme::create('OAuth2')
            ->type(SecurityScheme::TYPE_OAUTH2)
            ->flows($oauthFlow);

        $securityRequirement = SecurityRequirement::create()
            ->securityScheme($securityScheme)
            ->scopes('read:user');

        $openApi = OpenApi::create()
            ->security($securityRequirement);

        $this->assertEquals([
            'security' => [
                ['OAuth2' => ['read:user']],
            ],
        ], $openApi->toArray());
    }

    /** @test */
    public function create_with_no_scopes_works()
    {
        $securityScheme = SecurityScheme::create('OAuth2');

        $securityRequirement = SecurityRequirement::create()
            ->securityScheme($securityScheme);

        $openApi = OpenApi::create()
            ->security($securityRequirement);

        $this->assertEquals([
            'security' => [
                ['OAuth2' => []],
            ],
        ], $openApi->toArray());
    }
}
