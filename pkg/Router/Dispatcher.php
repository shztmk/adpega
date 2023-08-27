<?php

declare(strict_types=1);

namespace Pkg\Router;

final readonly class Dispatcher
{
    /**
     * @SuppressWarnings(PHPMD.Superglobals)
     * @psalm-suppress MixedInferredReturnType,PossiblyUndefinedArrayOffset, MixedMethodCall, MixedReturnStatement, PossiblyUnusedMethod
     */
    public function dispatch(Router $router): string
    {
        // phpcs:disable SlevomatCodingStandard.Variables.DisallowSuperGlobalVariable.DisallowedSuperGlobalVariable
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $getParams = $_GET;
        $postParams = $_POST;
        // phpcs:enable

        $handler = $router->get(
            HttpMethod::from($httpMethod),
            $path,
        );

        $class = new $handler['className']();
        $method = $handler['method'];
        return $class->$method($getParams, $postParams);
    }
}
