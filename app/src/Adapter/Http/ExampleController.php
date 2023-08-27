<?php

declare(strict_types=1);

namespace Adpega\App\Adapter\Http;

final readonly class ExampleController
{
    /**
     * phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification
     *
     * @SuppressWarnings(PHPMD.CamelCaseParameterName)
     */
    public function index(array $getParam, array $_postParam): string
    {
        if (array_key_exists('user', $getParam) && is_string($getParam['user'])) {
            return sprintf('Hello World, %s!', $getParam['user']);
        }
        return 'Hello World!';
    }
}
