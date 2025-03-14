<?php

declare(strict_types=1);

namespace Resolution07\User\Domain\Repositories;

use Resolution07\User\Domain\Entities\User;
use Resolution07\User\Domain\Exceptions\UserNotFoundException;
use Resolution07\User\Domain\Exceptions\UserReadException;
use Resolution07\User\Domain\ValueObjects\LoginValueObject;

interface FindUserRepositoryInterface
{
    /**
     * @param LoginValueObject $login
     * @return User
     * @throws UserReadException
     * @throws UserNotFoundException
     */
    public function findByLogin(LoginValueObject $login): User;
}
