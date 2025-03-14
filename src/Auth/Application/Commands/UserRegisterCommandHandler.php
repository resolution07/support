<?php

declare(strict_types=1);

namespace Resolution07\Auth\Application\Commands;

use Resolution07\Auth\Application\DTO\UserDTO;
use Resolution07\Auth\Domain\Exceptions\AuthenticationDataRetrieveException;
use Resolution07\Auth\Domain\Exceptions\RegisteredUserAlreadyExistsException;
use Resolution07\Auth\Domain\Repositories\UserExistenceRepositoryInterface;
use Resolution07\Auth\Domain\Repositories\UserRegisterRepositoryInterface;
use Resolution07\Auth\Domain\UserRegistrationAggregate;
use Resolution07\Auth\Domain\ValueObjects\EmailValueObject;
use Resolution07\Auth\Domain\ValueObjects\LoginValueObject;
use Resolution07\Auth\Domain\ValueObjects\NameValueObject;
use Resolution07\Auth\Domain\ValueObjects\PasswordValueObject;
use Resolution07\Auth\Domain\ValueObjects\PatronymicValueObject;
use Resolution07\Auth\Domain\ValueObjects\SurnameValueObject;
use Resolution07\Shared\Domain\Exceptions\DomainException;

final readonly class UserRegisterCommandHandler
{
    public function __construct(
        private UserRegisterRepositoryInterface $userRegisterRepository,
        private UserExistenceRepositoryInterface $userExistenceRepository
    ) {
    }

    /**
     * @param UserRegisterCommand $command
     * @return UserDTO
     * @throws DomainException
     * @throws AuthenticationDataRetrieveException
     * @throws RegisteredUserAlreadyExistsException
     */
    public function handle(UserRegisterCommand $command): UserDTO
    {
        if ($this->userExistenceRepository->isExists(new LoginValueObject($command->login))) {
            throw new RegisteredUserAlreadyExistsException();
        }

        $userRegisterAggregate = new UserRegistrationAggregate(
            new LoginValueObject($command->login),
            new EmailValueObject($command->email),
            new NameValueObject($command->name),
            new SurnameValueObject($command->surname),
            new PatronymicValueObject($command->patronymic),
            new PasswordValueObject($command->password),
            new PasswordValueObject($command->confirmPassword),
        );

        $userRegisterAggregate = $this->userRegisterRepository->register($userRegisterAggregate);

        return new UserDTO(
            $userRegisterAggregate->getLogin()->value(),
            $userRegisterAggregate->getEmail()->value(),
            $userRegisterAggregate->getName()->value(),
            $userRegisterAggregate->getSurname()->value(),
            $userRegisterAggregate->getPatronymic()->value()
        );
    }
}
