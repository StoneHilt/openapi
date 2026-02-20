<?php

namespace Examples\Petstore\OpenApi\Parameters;

use StoneHilt\OpenApi\Objects\Parameter;
use StoneHilt\OpenApi\Objects\Schema;
use StoneHilt\OpenApi\Factories\ParametersFactory;

class ListPetsParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('limit')
                ->description('How many items to return at one time (max 100)')
                ->required(false)
                ->schema(
                    Schema::integer()->format(Schema::FORMAT_INT32)
                ),

        ];
    }
}
