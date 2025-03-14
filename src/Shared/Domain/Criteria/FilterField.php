<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain\Criteria;

use Resolution07\Shared\Domain\ValueObjects\StringValueObject;

final class FilterField extends StringValueObject
{
    protected function assertValue(string $value): void
    {
    }
}
