<?php

declare(strict_types=1);

namespace Adpega\AppTests;

use Adpega\App\Example;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Adpega\App\Example::sum
 * @see https://docs.phpunit.de/en/10.0/attributes.html
 * @psalm-suppress UnusedClass
 */
final class ExampleTest extends TestCase
{
    #[Test]
    #[DataProvider('additionProvider')]
    #[TestDox('Adding $left to $right results in $expected')]
    public function testAdd(int $expected, int $left, int $right): void
    {
        self::assertSame(
            $expected,
            (new Example())->sum($left, $right),
        );
    }

    /**
     * @return array<string , array<int>>
     */
    public static function additionProvider(): array
    {
        return [
            'data set 1' => [0, 0, 0],
            'data set 2' => [1, 1, 0],
            'data set 3' => [1, 0, 1],
            'data set 4' => [2, 1, 1],
        ];
    }
}
