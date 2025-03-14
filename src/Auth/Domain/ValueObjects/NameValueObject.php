<?php

declare(strict_types=1);

namespace Resolution07\Auth\Domain\ValueObjects;

use Resolution07\Shared\Domain\ValueObjects\StringValueObject;

class NameValueObject extends StringValueObject
{
    protected function assertValue(string $value): void
    {
    }
}
