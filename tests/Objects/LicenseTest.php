<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Info;
use StoneHilt\OpenApi\Objects\License;
use StoneHilt\OpenApi\Tests\TestCase;

class LicenseTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $license = License::create()
            ->name('MIT')
            ->url('https://goldspecdigital.com');

        $info = Info::create()
            ->license($license);

        $this->assertEquals([
            'license' => [
                'name' => 'MIT',
                'url' => 'https://goldspecdigital.com',
            ],
        ], $info->toArray());
    }
}
