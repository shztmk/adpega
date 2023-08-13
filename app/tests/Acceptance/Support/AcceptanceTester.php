<?php

declare(strict_types=1);

namespace Adpega\AppTests\Acceptance\Support;

use Codeception\Actor;
use Codeception\Attribute\Then;
use Codeception\Attribute\When;

/**
 * @psalm-suppress UnusedClass
 */
final class AcceptanceTester extends Actor
{
    use _generated\AcceptanceTesterActions;

    #[When('I access the root URL with the query string { user=:user }')]
    public function iAccessTheRootURLWithTheQueryString(string $user): void
    {
        $this->amOnPage('/?XDEBUG_TRIGGER&user=' . $user);
    }

    #[Then('the response body is :responseBody')]
    public function theResponseBodyIs(string $responseBody): void
    {
        $this->see($responseBody);
    }
}
