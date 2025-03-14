<?php

declare(strict_types=1);

namespace Resolution07\User\Infrastructure\Repositories\InMemory;

use Resolution07\User\Domain\Entities\User;
use Resolution07\User\Domain\Repositories\CreateUserRepositoryInterface;
use Resolution07\User\Domain\ValueObjects\LoginValueObject;

class CreateUserRepository implements CreateUserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function store(User $user): User
    {
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function isUserExists(LoginValueObject $login): bool
    {
        return false;
    }
}
