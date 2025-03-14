<?php

declare(strict_types=1);

namespace Resolution07\User\Application\Commands;

use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\User\Application\DTO\UserDTO;
use Resolution07\User\Domain\Entities\User;
use Resolution07\User\Domain\Exceptions\CreateUserException;
use Resolution07\User\Domain\Exceptions\EmptyUserLoginException;
use Resolution07\User\Domain\Exceptions\EmptyUserNameException;
use Resolution07\User\Domain\Exceptions\EmptyUserSurnameException;
use Resolution07\User\Domain\Exceptions\InvalidEmailException;
use Resolution07\User\Domain\Exceptions\UserAlreadyExistsException;
use Resolution07\User\Domain\Exceptions\UserReadException;
use Resolution07\User\Domain\Repositories\CreateUserRepositoryInterface;
use Resolution07\User\Domain\ValueObjects\EmailValueObject;
use Resolution07\User\Domain\ValueObjects\LoginValueObject;
use Resolution07\User\Domain\ValueObjects\NameValueObject;
use Resolution07\User\Domain\ValueObjects\PatronymicValueObject;
use Resolution07\User\Domain\ValueObjects\SurnameValueObject;

final class CreateUserCommandHandler
{
    public function __construct(private CreateUserRepositoryInterface $repository)
    {
    }

    /**
     * @param CreateUserCommand $command
     * @return UserDTO
     * @throws DomainException
     * @throws UserAlreadyExistsException
     * @throws UserReadException
     * @throws CreateUserException
     * @throws EmptyUserLoginException
     * @throws EmptyUserNameException
     * @throws EmptyUserSurnameException
     * @throws InvalidEmailException
     */
    public function handle(CreateUserCommand $command): UserDTO
    {
        $login = new LoginValueObject($command->login);
        if ($this->repository->isUserExists($login)) {
            throw new UserAlreadyExistsException();
        }

        $user = $this->repository->store(
            new User(
                $login,
                new EmailValueObject($command->email),
                new NameValueObject($command->name),
                new SurnameValueObject($command->surname),
                new PatronymicValueObject($command->patronymic)
            )
        );

        return new UserDTO(
            $user->getLogin()->value(),
            $user->getEmail()->value(),
            $user->getName()->value(),
            $user->getSurname()->value(),
            $user->getPatronymic()->value()
        );
    }
}
