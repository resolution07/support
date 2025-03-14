<?php

declare(strict_types=1);

namespace Resolution07\User\Application\Factories;

use Resolution07\User\Application\DTO\UserDTO;
use Resolution07\User\Domain\Entities\User;

final readonly class UserDTOFactory
{
    public static function fromEntity(User $entity): UserDTO
    {
        return new UserDTO(
            $entity->getLogin()->value(),
            $entity->getEmail()->value(),
            $entity->getName()->value(),
            $entity->getSurname()->value(),
            $entity->getPatronymic()->value(),
        );
    }
}
