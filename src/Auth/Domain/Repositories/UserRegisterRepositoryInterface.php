<?php

declare(strict_types=1);

namespace Resolution07\Auth\Domain\Repositories;

use Resolution07\Auth\Domain\Exceptions\InvalidUserDataException;
use Resolution07\Auth\Domain\Exceptions\RegisteredUserAlreadyExistsException;
use Resolution07\Auth\Domain\Exceptions\UserRegistrationException;
use Resolution07\Auth\Domain\UserRegistrationAggregate;

interface UserRegisterRepositoryInterface
{
    /**
     * @param UserRegistrationAggregate $aggregate
     * @return UserRegistrationAggregate
     * @throws RegisteredUserAlreadyExistsException
     * @throws UserRegistrationException
     * @throws InvalidUserDataException
     */
    public function register(UserRegistrationAggregate $aggregate): UserRegistrationAggregate;
}
