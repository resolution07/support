<?php

declare(strict_types=1);

namespace Resolution07\Auth\Application\Commands;

final readonly class UserRegisterCommand
{
    public function __construct(
        public string $login,
        public string $email,
        public string $name,
        public string $surname,
        public string $patronymic,
        public string $password,
        public string $confirmPassword
    ) {
    }
}
