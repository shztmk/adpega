<?php

declare(strict_types=1);

namespace Adpega\App;

final readonly class Example
{
    public function sum(int $left, int $right): int
    {
        return $left + $right;
    }
}
