<?php

namespace StoneHilt\OpenApi\Builders\Paths\Operation;

use StoneHilt\OpenApi\Objects\Parameter;
use StoneHilt\OpenApi\Objects\Schema;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use ReflectionParameter;
use StoneHilt\OpenApi\Attributes\Parameters;
use StoneHilt\OpenApi\Factories\ParametersFactory;
use StoneHilt\OpenApi\RouteInformation;
use StoneHilt\OpenApi\SchemaHelpers;

class ParametersBuilder
{
    public function build(RouteInformation $route): array
    {
        $pathParameters = $this->buildPath($route);
        $attributedParameters = $this->buildAttribute($route);

        return $pathParameters->merge($attributedParameters)->toArray();
    }

    protected function buildPath(RouteInformation $route): Collection
    {
        return collect($route->parameters)
            ->map(static function (array $parameter) use ($route) {
                $schema = Schema::string();

                /** @var ReflectionParameter|null $reflectionParameter */
                $reflectionParameter = collect($route->actionParameters)
                    ->first(static fn (ReflectionParameter $reflectionParameter) => $reflectionParameter->name === $parameter['name']);

                if ($reflectionParameter) {
                    // The reflected param has no type, so ignore (should be defined in a ParametersFactory instead)
                    if ($reflectionParameter->getType() === null) {
                        return null;
                    }

                    if ($reflectionParameter->getType() instanceof \ReflectionNamedType) {
                        $schema = SchemaHelpers::guessFromReflectionType($reflectionParameter->getType());
                    }
                }

                if (is_null($route->actionDocBlock)) {
                    throw new \Exception('Missing docblock for route: '.$route->uri);
                }
                /** @var Param $description */
                $description = collect($route->actionDocBlock->getTagsByName('param'))
                    ->first(static fn (Param $param) => Str::snake($param->getVariableName()) === Str::snake($parameter['name']));

                return Parameter::path()->name($parameter['name'])
                    ->required()
                    ->description(optional(optional($description)->getDescription())->render())
                    ->schema($schema);
            })
            ->filter();
    }

    protected function buildAttribute(RouteInformation $route): Collection
    {
        /** @var Parameters|null $parameters */
        $parameters = $route->actionAttributes->first(static fn ($attribute) => $attribute instanceof Parameters, []);

        if ($parameters) {
            /** @var ParametersFactory $parametersFactory */
            $parametersFactory = app($parameters->factory);

            $parameters = $parametersFactory->build();
        }

        return collect($parameters);
    }
}
