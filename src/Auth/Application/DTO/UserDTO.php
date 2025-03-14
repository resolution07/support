<?php

declare(strict_types=1);

namespace Resolution07\Auth\Application\DTO;

final readonly class UserDTO
{
    public function __construct(
        public string $login,
        public string $email,
        public string $name,
        public string $surname,
        public string $patronymic,
    ) {
    }
}
