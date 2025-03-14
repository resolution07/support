<?php

declare(strict_types=1);

namespace Resolution07\User\Domain\Repositories;

use Resolution07\User\Domain\Entities\User;
use Resolution07\User\Domain\Exceptions\CreateUserException;
use Resolution07\User\Domain\Exceptions\UserReadException;
use Resolution07\User\Domain\ValueObjects\LoginValueObject;

interface CreateUserRepositoryInterface
{
    /**
     * @param User $user
     * @return User
     * @throws CreateUserException
     */
    public function store(User $user): User;

    /**
     * @param LoginValueObject $login
     * @return bool
     * @throws UserReadException
     */
    public function isUserExists(LoginValueObject $login): bool;
}
