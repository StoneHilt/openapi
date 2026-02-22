<?php

namespace StoneHilt\OpenApi\Tests\Builders;

use StoneHilt\OpenApi\Objects\Operation;
use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Attributes\Extension;
use StoneHilt\OpenApi\Builders\ExtensionsBuilder;
use StoneHilt\OpenApi\Factories\ExtensionFactory;
use StoneHilt\OpenApi\Tests\TestCase;

class ExtensionsBuilderTest extends TestCase
{
    public function testBuildUsingFactory(): void
    {
        $operation = Operation::create()->action('get');

        $openApi = OpenApi::create()
            ->paths(
                PathItem::create()
                    ->uri('/foo')
                    ->operations($operation)
            );

        /** @var ExtensionsBuilder $builder */
        $builder = resolve(ExtensionsBuilder::class);
        $builder->build($operation, collect([
            new Extension(factory: FakeExtension::class),
        ]));

        self::assertSame([
            'paths' => [
                '/foo' => [
                    'get' => [
                        'x-uuid' => ['format' => 'uuid', 'type' => 'string'],
                    ],
                ],
            ],
        ], $openApi->toArray());
    }

    public function testBuildUsingKeyValue(): void
    {
        $operation = Operation::create()->action('get');

        $openApi = OpenApi::create()
            ->paths(
                PathItem::create()
                    ->uri('/foo')
                    ->operations($operation)
            );

        /** @var ExtensionsBuilder $builder */
        $builder = resolve(ExtensionsBuilder::class);
        $builder->build($operation, collect([
            new Extension(key: 'foo', value: 'bar'),
            new Extension(key: 'x-key', value: '1'),
        ]));

        self::assertSame([
            'paths' => [
                '/foo' => [
                    'get' => [
                        'x-foo' => 'bar',
                        'x-key' => '1',
                    ],
                ],
            ],
        ], $openApi->toArray());
    }
}

class FakeExtension extends ExtensionFactory
{
    public function key(): string
    {
        return 'uuid';
    }

    /**
     * @return string|null|array
     */
    public function value()
    {
        return Schema::string()->format(Schema::FORMAT_UUID);
    }
}
