<?php

declare(strict_types=1);

namespace Adpega\AppTests\Acceptance\Support\Modules;

use Codeception\Module;
use Codeception\TestInterface;

/**
 * @psalm-suppress UnusedClass
 */
final class CachegrindNaming extends Module
{
    /**
     * Add the "Feature" and "Scenario" names to the filename of cachegrind.
     *
     * - before .. cachegrind.out.0.1691720093.0.gz
     * - after ... cachegrind.out.1.1691720093.example.example.0.gz
     *     - 0: cachegrind (immutable string)
     *     - 1: out (immutable string)
     *     - 2: 0 when output by xdebug, 1 when renamed by this class
     *     - 3: timestamp ( %t in https://xdebug.org/docs/all_settings#trace_output_name )
     *     - 4: name of feature
     *     - 5: name of scenario
     *     - 6: index number (serial number)
     *
     * phpcs:disable PSR2.Methods.MethodDeclaration.Underscore
     *
     * @psalm-suppress UnusedClass
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public function _after(TestInterface $test): void
    {
        parent::_after($test);

        $profilers = scandir('/var/www/storage/profilers', SCANDIR_SORT_ASCENDING);

        if ($profilers === []) {
            return;
        }

        $index = 0;
        foreach ($profilers as $oldName) {
            if (str_starts_with($oldName, 'cachegrind.out.0.') === false) {
                continue;
            }

            $newName = sprintf(
                '/var/www/storage/profilers/cachegrind.out.1.%d.%s.%s.%d.gz',
                explode('.', $oldName)[3],
                $test->getMetadata()->getFeature(),
                $test->getMetadata()->getName(),
                $index,
            );

            rename('/var/www/storage/profilers/' . $oldName, $newName);
            $index += 1;
        }
    }
}
