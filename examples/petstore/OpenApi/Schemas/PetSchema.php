<?php

namespace Examples\Petstore\OpenApi\Schemas;

use StoneHilt\OpenApi\Contracts\SchemaContract;
use StoneHilt\OpenApi\Exceptions\InvalidArgumentException;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Contracts\Reusable;
use StoneHilt\OpenApi\Factories\SchemaFactory;

class PetSchema extends SchemaFactory implements Reusable
{
    /**
     * @return Schema
     *
     * @throws InvalidArgumentException
     */
    public function build(): SchemaContract
    {
        return Schema::object('Pet')
            ->required('id', 'name')
            ->properties(
                Schema::integer('id')->format(Schema::FORMAT_INT64),
                Schema::string('name'),
                Schema::string('tag')
            );
    }
}
