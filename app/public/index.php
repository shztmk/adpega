<?php

declare(strict_types=1);

// phpcs:disable SlevomatCodingStandard.Variables.DisallowSuperGlobalVariable.DisallowedSuperGlobalVariable
if (array_key_exists('user', $_GET) && is_string($_GET['user'])) {
    echo sprintf('Hello World, %s!', $_GET['user']);
} else {
    echo 'Hello World!';
}
// phpcs:enable