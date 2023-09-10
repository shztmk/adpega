<?php

declare(strict_types=1);

namespace Pkg\SuperGlobal;

use Pkg\SuperGlobal\Exceptions\NoSpecifiedKeyException;

final readonly class GlobalGateway
{
    public function __construct(private SuperGlobal $superGlobal)
    {
    }

    public function all(): array
    {
        return $this->superGlobal->toArray();
    }

    public function get(string $key): mixed
    {
        $value = static::tryGet($key);
        if ($value !== null) {
            return $value;
        }
        throw new NoSpecifiedKeyException(
            sprintf('Specified key: %s does not exist in %s', $key, $this->superGlobal->value),
        );
    }

    public function tryGet(string $key, mixed $default = null): mixed
    {
        $superGlobal = $this->superGlobal->toArray();
        if (array_key_exists($key, $superGlobal)) {
            return $superGlobal[$key];
        }
        return $default;
    }
}
