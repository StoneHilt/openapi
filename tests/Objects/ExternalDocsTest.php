<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\ExternalDocs;
use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Tests\TestCase;

class ExternalDocsTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $externalDocs = ExternalDocs::create()
            ->description('GitHub Repo')
            ->url('https://github.com/goldspecdigital/oooas');

        $openApi = OpenApi::create()
            ->externalDocs($externalDocs);

        $this->assertEquals([
            'externalDocs' => [
                'description' => 'GitHub Repo',
                'url' => 'https://github.com/goldspecdigital/oooas',
            ],
        ], $openApi->toArray());
    }
}
