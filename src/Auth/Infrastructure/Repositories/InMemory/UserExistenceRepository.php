<?php

declare(strict_types=1);

namespace Resolution07\Auth\Infrastructure\Repositories\InMemory;

use Resolution07\Auth\Domain\Repositories\UserExistenceRepositoryInterface;
use Resolution07\Auth\Domain\ValueObjects\LoginValueObject;

class UserExistenceRepository implements UserExistenceRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function isExists(LoginValueObject $login): bool
    {
        return false;
    }
}
