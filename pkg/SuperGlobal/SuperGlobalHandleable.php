<?php

declare(strict_types=1);

namespace Pkg\SuperGlobal;

trait SuperGlobalHandleable
{
    protected static GlobalGateway|null $gateway = null;

    abstract protected static function getSuperGlobal(): SuperGlobal;

    protected static function getGateway(): GlobalGateway
    {
        if (static::$gateway === null) {
            static::$gateway = new GlobalGateway(static::getSuperGlobal());
        }
        return static::$gateway;
    }

    public static function all(): array
    {
        return static::getGateway()->all();
    }

    /**
     * @psalm-suppress MixedInferredReturnType, PossiblyUnusedMethod
     */
    public static function get(string $key): string
    {
        return static::getGateway()->get($key);
    }

    /**
     * @psalm-suppress MixedInferredReturnType, PossiblyUnusedMethod
     */
    public static function tryGet(string $key, mixed $default = null): string
    {
        return static::getGateway()->tryGet($key, $default);
    }
}