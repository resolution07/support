<?php

declare(strict_types=1);

namespace Resolution07\Auth\Infrastructure;

use Resolution07\Auth\Domain\Exceptions\AuthenticationDataRetrieveException;
use Resolution07\Auth\Domain\Exceptions\InvalidUserDataException;
use Resolution07\Auth\Domain\Exceptions\RegisteredUserAlreadyExistsException;
use Resolution07\Auth\Domain\Exceptions\UserRegistrationException;
use Resolution07\Shared\Domain\Exceptions\DomainException;
use Resolution07\Shared\Domain\ExceptionTransformerInterface;
use Resolution07\User\Domain\Exceptions\CreateUserException;
use Resolution07\User\Domain\Exceptions\EmptyUserLoginException;
use Resolution07\User\Domain\Exceptions\EmptyUserNameException;
use Resolution07\User\Domain\Exceptions\EmptyUserSurnameException;
use Resolution07\User\Domain\Exceptions\InvalidEmailException;
use Resolution07\User\Domain\Exceptions\UserAlreadyExistsException;
use Resolution07\User\Domain\Exceptions\UserReadException;
use Throwable;

class ExceptionTransformer implements ExceptionTransformerInterface
{
    public function transform(Throwable $throwable): DomainException
    {
        return match ($throwable::class) {
            CreateUserException::class => new UserRegistrationException(
                $throwable->getMessage(),
                $throwable->getCode(),
                $throwable
            ),
            UserAlreadyExistsException::class => new RegisteredUserAlreadyExistsException(
                $throwable->getMessage(),
                $throwable->getCode(),
                $throwable
            ),
            UserReadException::class => new AuthenticationDataRetrieveException(
                $throwable->getMessage(),
                $throwable->getCode(),
                $throwable
            ),
            InvalidEmailException::class,
            EmptyUserLoginException::class,
            EmptyUserNameException::class,
            EmptyUserSurnameException::class => new InvalidUserDataException(
                $throwable->getMessage(),
                $throwable->getCode(),
                $throwable
            )
        };
    }
}
