<?php

namespace StoneHilt\OpenApi\Builders\Paths\Operation;

use StoneHilt\OpenApi\Objects\RequestBody;
use StoneHilt\OpenApi\Attributes\RequestBody as RequestBodyAttribute;
use StoneHilt\OpenApi\Contracts\Reusable;
use StoneHilt\OpenApi\Factories\RequestBodyFactory;
use StoneHilt\OpenApi\RouteInformation;

class RequestBodyBuilder
{
    public function build(RouteInformation $route): ?RequestBody
    {
        /** @var RequestBodyAttribute|null $requestBody */
        $requestBody = $route->actionAttributes->first(static fn (object $attribute) => $attribute instanceof RequestBodyAttribute);

        if ($requestBody) {
            /** @var RequestBodyFactory $requestBodyFactory */
            $requestBodyFactory = app($requestBody->factory);

            $requestBody = $requestBodyFactory->build();

            if ($requestBodyFactory instanceof Reusable) {
                return RequestBody::ref('#/components/requestBodies/'.$requestBody->objectId);
            }
        }

        return $requestBody;
    }
}
