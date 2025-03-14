<?php

declare(strict_types=1);

namespace Resolution07\User\Domain\Entities;

use Resolution07\User\Domain\ValueObjects\EmailValueObject;
use Resolution07\User\Domain\ValueObjects\LoginValueObject;
use Resolution07\User\Domain\ValueObjects\NameValueObject;
use Resolution07\User\Domain\ValueObjects\PatronymicValueObject;
use Resolution07\User\Domain\ValueObjects\SurnameValueObject;

final class User
{
    public function __construct(
        private LoginValueObject $login,
        private EmailValueObject $email,
        private NameValueObject $name,
        private SurnameValueObject $surname,
        private PatronymicValueObject $patronymic
    ) {
    }

    public function getLogin(): LoginValueObject
    {
        return $this->login;
    }

    public function getEmail(): EmailValueObject
    {
        return $this->email;
    }

    public function getName(): NameValueObject
    {
        return $this->name;
    }

    public function getSurname(): SurnameValueObject
    {
        return $this->surname;
    }

    public function getPatronymic(): PatronymicValueObject
    {
        return $this->patronymic;
    }

    public function getFullName(): string
    {
        return implode(' ', [
            $this->surname->value(),
            $this->name->value(),
            $this->patronymic->value()
        ]);
    }
}
