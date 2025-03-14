<?php

declare(strict_types=1);

namespace Resolution07\User\Application\Queries;

use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\User\Application\DTO\UserDTO;
use Resolution07\User\Domain\Exceptions\EmptyUserLoginException;
use Resolution07\User\Domain\Exceptions\UserNotFoundException;
use Resolution07\User\Domain\Exceptions\UserReadException;
use Resolution07\User\Domain\Repositories\FindUserRepositoryInterface;
use Resolution07\User\Domain\ValueObjects\LoginValueObject;

class FindUserByLoginQueryHandler
{
    public function __construct(private FindUserRepositoryInterface $repository)
    {
    }

    /**
     * @param FindUserByLoginQuery $query
     * @return UserDTO
     * @throws DomainException
     * @throws UserNotFoundException
     * @throws UserReadException
     * @throws EmptyUserLoginException
     */
    public function handle(FindUserByLoginQuery $query): UserDTO
    {
        $user = $this->repository->findByLogin(new LoginValueObject($query->login));
        return new UserDTO(
            $user->getLogin()->value(),
            $user->getEmail()->value(),
            $user->getName()->value(),
            $user->getSurname()->value(),
            $user->getPatronymic()->value(),
        );
    }
}
