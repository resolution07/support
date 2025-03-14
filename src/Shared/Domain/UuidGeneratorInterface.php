<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain;

use Resolution07\Shared\Domain\ValueObjects\Uuid;

interface UuidGeneratorInterface
{
    public function generate(): Uuid;
}
