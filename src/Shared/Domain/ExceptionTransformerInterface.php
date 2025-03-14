<?php

declare(strict_types=1);

namespace Resolution07\Shared\Domain;

use Resolution07\Shared\Domain\Exceptions\DomainException;
use Throwable;

interface ExceptionTransformerInterface
{
    public function transform(Throwable $throwable): DomainException;
}
