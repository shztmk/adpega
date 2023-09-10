<?php

declare(strict_types=1);

namespace Pkg\SuperGlobal\Elements;

use Pkg\SuperGlobal\SuperGlobal;
use Pkg\SuperGlobal\SuperGlobalHandleable;

class Server
{
    use SuperGlobalHandleable;

    protected static function getSuperGlobal(): SuperGlobal
    {
        return SuperGlobal::Server;
    }

    /**
     * @psalm-suppress MixedInferredReturnType, MixedReturnStatement
     */
    public static function requestMethod(): string
    {
        return static::getGateway()->get('REQUEST_METHOD');
    }

    /**
     * @psalm-suppress MixedInferredReturnType, MixedReturnStatement
     */
    public static function requestUri(): string
    {
        return static::getGateway()->get('REQUEST_URI');
    }
}