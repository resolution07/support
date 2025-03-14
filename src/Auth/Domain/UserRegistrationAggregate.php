<?php

declare(strict_types=1);

namespace Resolution07\Auth\Domain;

use Resolution07\Auth\Domain\Exceptions\PasswordNotConfirmedException;
use Resolution07\Auth\Domain\ValueObjects\EmailValueObject;
use Resolution07\Auth\Domain\ValueObjects\LoginValueObject;
use Resolution07\Auth\Domain\ValueObjects\NameValueObject;
use Resolution07\Auth\Domain\ValueObjects\PasswordHashValueObject;
use Resolution07\Auth\Domain\ValueObjects\PasswordValueObject;
use Resolution07\Auth\Domain\ValueObjects\PatronymicValueObject;
use Resolution07\Auth\Domain\ValueObjects\SurnameValueObject;
use Resolution07\Shared\Domain\Exceptions\DomainException;

final class UserRegistrationAggregate
{
    private PasswordHashValueObject $passwordHash;

    /**
     * @param LoginValueObject $login
     * @param EmailValueObject $email
     * @param NameValueObject $name
     * @param SurnameValueObject $surname
     * @param PatronymicValueObject $patronymic
     * @param PasswordValueObject $password
     * @param PasswordValueObject $confirmPassword
     * @throws PasswordNotConfirmedException
     * @throws DomainException
     */
    public function __construct(
        private LoginValueObject $login,
        private EmailValueObject $email,
        private NameValueObject $name,
        private SurnameValueObject $surname,
        private PatronymicValueObject $patronymic,
        private PasswordValueObject $password,
        private PasswordValueObject $confirmPassword
    ) {
        $this->assertPassword($this->password, $this->confirmPassword);
        $this->passwordHash = new PasswordHashValueObject(password_hash($this->password->value(), PASSWORD_ARGON2I));
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

    public function getPasswordHash(): PasswordHashValueObject
    {
        return $this->passwordHash;
    }

    /**
     * @param PasswordValueObject $password
     * @param PasswordValueObject $confirmPassword
     * @return void
     * @throws PasswordNotConfirmedException
     */
    private function assertPassword(PasswordValueObject $password, PasswordValueObject $confirmPassword): void
    {
        if (!$password->equalTo($confirmPassword)) {
            throw new PasswordNotConfirmedException();
        }
    }
}
