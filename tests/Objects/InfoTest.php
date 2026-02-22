<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Contact;
use StoneHilt\OpenApi\Objects\Info;
use StoneHilt\OpenApi\Objects\License;
use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Tests\TestCase;

class InfoTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $info = Info::create()
            ->title('Pretend API')
            ->description('A pretend API')
            ->termsOfService('https://goldspecdigital.com')
            ->contact(Contact::create())
            ->license(License::create())
            ->version('v1');

        $openApi = OpenApi::create()
            ->info($info);

        $this->assertEquals([
            'info' => [
                'title' => 'Pretend API',
                'description' => 'A pretend API',
                'termsOfService' => 'https://goldspecdigital.com',
                'contact' => [],
                'license' => [],
                'version' => 'v1',
            ],
        ], $openApi->toArray());
    }
}
