<?php

declare(strict_types=1);

namespace Resolution07\User\Infrastructure\Repositories\InMemory;

use Resolution07\User\Domain\Entities\User;
use Resolution07\User\Domain\Repositories\FindUserRepositoryInterface;
use Resolution07\User\Domain\ValueObjects\EmailValueObject;
use Resolution07\User\Domain\ValueObjects\LoginValueObject;
use Resolution07\User\Domain\ValueObjects\NameValueObject;
use Resolution07\User\Domain\ValueObjects\PatronymicValueObject;
use Resolution07\User\Domain\ValueObjects\SurnameValueObject;

class FindUserRepository implements FindUserRepositoryInterface
{
    public function findByLogin(LoginValueObject $login): User
    {
        return new User(
            new LoginValueObject('resolution07'),
            new EmailValueObject('apacah@yandex.by'),
            new NameValueObject('Vladamir'),
            new SurnameValueObject('Mukashev'),
            new PatronymicValueObject('Timurovich')
        );
    }
}
