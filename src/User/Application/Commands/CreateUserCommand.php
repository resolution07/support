<?php

declare(strict_types=1);

namespace Resolution07\User\Application\Commands;

final readonly class CreateUserCommand
{
    public function __construct(
        public string $login,
        public string $email,
        public string $name,
        public string $surname,
        public string $patronymic
    ) {
    }
}
