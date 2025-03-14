<?php

declare(strict_types=1);

namespace Resolution07\Auth\Domain\Repositories;

use Resolution07\Auth\Domain\Exceptions\AuthenticationDataRetrieveException;
use Resolution07\Auth\Domain\ValueObjects\LoginValueObject;

interface UserExistenceRepositoryInterface
{
    /**
     * @param LoginValueObject $login
     * @return bool
     * @throws AuthenticationDataRetrieveException
     */
    public function isExists(LoginValueObject $login): bool;
}
