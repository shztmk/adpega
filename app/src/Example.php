<?php

declare(strict_types=1);

namespace Adpega\App;

use JetBrains\PhpStorm\Deprecated;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;

#[Immutable]
final readonly class Example
{
    #[Pure]
    public function sum(int $left, int $right): int
    {
        return $left + $right;
    }

    /**
     * @psalm-suppress PossiblyUnusedMethod
     * @SuppressWarnings(PHPMD.ExitExpression)
     */
    #[NoReturn]
    #[Deprecated]
    public function terminate(int $status): void
    {
        exit($status);
    }
}
