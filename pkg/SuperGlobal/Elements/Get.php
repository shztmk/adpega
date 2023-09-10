<?php

declare(strict_types=1);

namespace Pkg\SuperGlobal\Elements;

use Pkg\SuperGlobal\SuperGlobal;
use Pkg\SuperGlobal\SuperGlobalHandleable;

class Get
{
    use SuperGlobalHandleable;

    protected static function getSuperGlobal(): SuperGlobal
    {
        return SuperGlobal::Get;
    }
}