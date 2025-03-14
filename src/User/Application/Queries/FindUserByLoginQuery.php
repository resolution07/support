<?php

declare(strict_types=1);

namespace Resolution07\User\Application\Queries;

final readonly class FindUserByLoginQuery
{
    public function __construct(public string $login)
    {
    }
}
