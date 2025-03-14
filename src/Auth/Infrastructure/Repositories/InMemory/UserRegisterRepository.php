<?php

declare(strict_types=1);

namespace Resolution07\Auth\Infrastructure\Repositories\InMemory;

use Resolution07\Auth\Domain\Exceptions\RegisteredUserAlreadyExistsException;
use Resolution07\Auth\Domain\Repositories\UserRegisterRepositoryInterface;
use Resolution07\Auth\Domain\UserRegistrationAggregate;
use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\Shared\Domain\ExceptionTransformerInterface;
use Resolution07\User\Application\Commands\CreateUserCommand;
use Resolution07\User\Application\Commands\CreateUserCommandHandler;
use Resolution07\User\Domain\Exceptions\CreateUserException;
use Resolution07\User\Domain\Exceptions\EmptyUserLoginException;
use Resolution07\User\Domain\Exceptions\EmptyUserNameException;
use Resolution07\User\Domain\Exceptions\EmptyUserSurnameException;
use Resolution07\User\Domain\Exceptions\InvalidEmailException;
use Resolution07\User\Domain\Exceptions\UserAlreadyExistsException;
use Resolution07\User\Domain\Exceptions\UserReadException;
use Throwable;

final class UserRegisterRepository implements UserRegisterRepositoryInterface
{
    private array $storage = [];
    private bool $transactionActive = false;

    public function __construct(
        private CreateUserCommandHandler $createUserCommandHandler,
        private ExceptionTransformerInterface $exceptionTransformer,
    ) {
    }


    /**
     * @inheritDoc
     * @throws DomainException
     */
    public function register(UserRegistrationAggregate $aggregate): UserRegistrationAggregate
    {
        try {
            $this->beginTransaction();

            $this->createUser($aggregate);
            $this->storeAuthCredentials($aggregate);

            $this->commitTransaction();
            return $aggregate;
        } catch (Throwable $e) {
            $this->rollbackTransaction();
            throw $this->exceptionTransformer->transform($e);
        }
    }

    /**
     * @param UserRegistrationAggregate $aggregate
     * @return void
     * @throws DomainException
     * @throws EmptyUserLoginException
     * @throws EmptyUserNameException
     * @throws EmptyUserSurnameException
     * @throws InvalidEmailException
     * @throws UserAlreadyExistsException
     * @throws UserReadException
     * @throws CreateUserException
     */
    private function createUser(UserRegistrationAggregate $aggregate): void
    {
        $this->createUserCommandHandler->handle(
            new CreateUserCommand(
                $aggregate->getLogin()->value(),
                $aggregate->getEmail()->value(),
                $aggregate->getName()->value(),
                $aggregate->getSurname()->value(),
                $aggregate->getPatronymic()->value()
            )
        );
    }


    /**
     * @param UserRegistrationAggregate $aggregate
     * @return void
     * @throws RegisteredUserAlreadyExistsException
     */
    private function storeAuthCredentials(UserRegistrationAggregate $aggregate): void
    {
        $key = $aggregate->getLogin()->value();

        if (isset($this->storage[$key])) {
            throw new RegisteredUserAlreadyExistsException();
        }

        $this->storage[$key] = [
            'email' => $aggregate->getEmail()->value(),
            'password_hash' => $aggregate->getPasswordHash()->value()
        ];
    }

    private function beginTransaction(): void
    {
        $this->transactionActive = true;
    }

    private function commitTransaction(): void
    {
        $this->transactionActive = false;
    }

    private function rollbackTransaction(): void
    {
        $this->transactionActive = false;
    }
}
