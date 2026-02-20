<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\ExternalDocs;
use StoneHilt\OpenApi\Objects\Tag;
use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Tests\TestCase;

class TagTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $tag = Tag::create()
            ->name('Users')
            ->description('All user endpoints')
            ->externalDocs(ExternalDocs::create());

        $openApi = OpenApi::create()
            ->tags($tag);

        $this->assertEquals([
            'tags' => [
                [
                    'name' => 'Users',
                    'description' => 'All user endpoints',
                    'externalDocs' => [],
                ],
            ],
        ], $openApi->toArray());
    }
}
