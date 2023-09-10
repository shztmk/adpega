<?php

declare(strict_types=1);

namespace Pkg\SuperGlobal;

enum SuperGlobal: string
{
    case Server = '$_SERVER';
    case Get = '$_GET';
    case Post = '$_POST';

    public function toArray(): array
    {
        return match ($this) {
            self::Server => $_SERVER,
            self::Post => $_POST,
            self::Get => $_GET,
        };
    }
}
