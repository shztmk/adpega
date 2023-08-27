<?php

declare(strict_types=1);

namespace Pkg\Router;

final class Router
{
    /**
     * @var array<string, array{className: class-string, method: string}>
     */
    private array $routes = [];

    /**
     * @param HttpMethod $httpMethod
     * @param string $path
     * @param class-string $className
     * @param string $method
     * @return void
     */
    public function add(HttpMethod $httpMethod, string $path, string $className, string $method): void
    {
        $this->routes[$this->convertToKey($httpMethod, $path)] = [
            'className' => $className,
            'method' => $method,
        ];
    }

    /**
     * @internal
     */
    public function convertToKey(HttpMethod $httpMethod, string $path): string
    {
        return sprintf('%s::%s', $httpMethod->value, $path);
    }

    /**
     * @internal
     * @param HttpMethod $httpMethod
     * @param string $path
     * @return array{className: class-string, method: string}
     */
    public function get(HttpMethod $httpMethod, string $path): array
    {
        $key = $this->convertToKey($httpMethod, $path);
        if (array_key_exists($key, $this->routes)) {
            return $this->routes[$key];
        }
        throw new \RuntimeException('Attempted to retrieve an unregistered route.');
    }
}