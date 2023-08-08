<?php

declare(strict_types=1);

namespace Adpega\AppTests\Unit;

use Adpega\App\Example;
use JetBrains\PhpStorm\Language;
use PDO;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Redis;

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

    /**
     * @param array<int|string, string> $toBeContained
     */
    #[Test]
    #[DataProvider('connectPdoProvider')]
    public function testConnectPdo(array $toBeContained, #[Language('SQL')] string $query): void
    {
        $dbh = new PDO('mysql:host=mysql', 'adpega', 'adpega');
        $resultSet = $dbh->query($query)->fetchAll();
        self::assertContains($toBeContained, $resultSet);
    }

    /**
     * @return array<string , array{0: array<int|string, string>, 1: string}>
     */
    public static function connectPdoProvider(): array
    {
        return [
            'data set 1' => [
                [
                    'Database' => 'information_schema',
                    0 => 'information_schema',
                ],
                'SHOW DATABASES',
            ],
            'data set 2' => [
                [
                    'current_user()' => 'adpega@%',
                    0 => 'adpega@%',
                ],
                'SELECT current_user()',
            ],
        ];
    }

    #[Test]
    public function testConnectRedis(): void
    {
        self::assertTrue(
            (new Redis())->connect('redis'),
        );
    }
}
