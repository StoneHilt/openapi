<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Discriminator;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

class DiscriminatorTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $discriminator = Discriminator::create()
            ->propertyName('Discriminator Name')
            ->mapping(['key' => 'value']);

        $schema = Schema::object()
            ->discriminator($discriminator);

        $this->assertEquals([
            'type' => 'object',
            'discriminator' => [
                'propertyName' => 'Discriminator Name',
                'mapping' => [
                    'key' => 'value',
                ],
            ],
        ], $schema->toArray());
    }
}
