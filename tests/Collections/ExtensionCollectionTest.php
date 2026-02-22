<?php

namespace StoneHilt\OpenApi\Tests\Collections;

use PHPUnit\Framework\Attributes\DataProvider;
use StoneHilt\OpenApi\Exceptions\PropertyDoesNotExistException;
use StoneHilt\OpenApi\Objects\Components;
use StoneHilt\OpenApi\Objects\Operation;
use StoneHilt\OpenApi\Objects\PathItem;
use StoneHilt\OpenApi\Objects\Response;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Tests\TestCase;

/**
 * Class ExtensionCollectionTest
 *
 * @package StoneHilt\OpenApi\Tests\Collections
 */
class ExtensionCollectionTest extends TestCase
{
    /**
     * @test
     * @param string|Schema $schema
     */
    #[DataProvider('provider_schemasData')]
    public function create_with_extensions($schema)
    {
        $object = $schema::create()
            ->x('key', 'value')
            ->x('x-foo', 'bar')
            ->x('x-baz', null)
            ->x('x-array', Schema::array()->items(Schema::string()));

        $this->assertEquals([
            'x-key' => 'value',
            'x-foo' => 'bar',
            'x-baz' => null,
            'x-array' => Schema::array()->items(Schema::string()),
        ], $object->toArray());

        $this->assertEquals(
            '{"x-key":"value","x-foo":"bar","x-baz":null,"x-array":{"type":"array","items":{"type":"string"}}}',
            $object->toJson()
        );
    }

    /** @test */
    public function can_unset_extensions()
    {
        $object = Schema::create()
            ->x('key', 'value')
            ->x('x-foo', 'bar')
            ->x('x-baz', null);

        $object = $object->x('key');

        $this->assertEquals([
            'x-foo' => 'bar',
            'x-baz' => null,
        ], $object->toArray());

        $this->assertEquals('{"x-foo":"bar","x-baz":null}', $object->toJson());
    }

    /**
     * @test
     * @param string|Schema $schema
     */
    #[DataProvider('provider_schemasData')]
    public function get_single_extension($schema)
    {
        $object = $schema::create()->x('foo', 'bar');

        $this->assertEquals('bar', $object->{'x-foo'});
    }

    /**
     * @test
     * @param string|Schema $schema
     */
    #[DataProvider('provider_schemasData')]
    public function get_single_extension_does_not_exist($schema)
    {
        $object = $schema::create()->x('foo', 'bar');

        $this->expectException(PropertyDoesNotExistException::class);
        $this->expectExceptionMessage('[x-key] is not a valid property');
        $this->assertEquals('bar', $object->{'x-key'});
    }

    /**
     * @test
     * @param string|Schema $schema
     */
    #[DataProvider('provider_schemasData')]
    public function get_all_extensions($schema)
    {
        $object = $schema::create();

        $this->assertEquals([], $object->x);

        $object = $object
            ->x('key', 'value')
            ->x('foo', 'bar');

        $this->assertEquals(['x-key' => 'value', 'x-foo' => 'bar'], $object->x);
    }

    /**
     * @return array
     */
    public static function provider_schemasData(): array
    {
        return [
            [Components::class],
            [Operation::class],
            [PathItem::class],
            [Response::class],
            [Schema::class],
        ];
    }
}
