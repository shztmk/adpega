<?php

declare(strict_types=1);

namespace Pkg\Router;

use Pkg\SuperGlobal\Elements\Get;
use Pkg\SuperGlobal\Elements\Post;
use Pkg\SuperGlobal\Elements\Server;

final readonly class Dispatcher
{
    /**
     * @psalm-suppress MixedInferredReturnType, MixedMethodCall, MixedReturnStatement
     */
    public function dispatch(Router $router): string
    {
        $httpMethod = Server::requestMethod();
        $path = explode('?', Server::requestUri())[0];
        $getParams = Get::all();
        $postParams = Post::all();
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
