<?php

declare(strict_types=1);

namespace Resolution07\User\Application\ExceptionHandlers\HTTP;

use JetBrains\PhpStorm\ArrayShape;
use Resolution07\User\Domain\Exceptions\CreateUserException;
use Resolution07\User\Domain\Exceptions\EmptyUserLoginException;
use Resolution07\User\Domain\Exceptions\EmptyUserNameException;
use Resolution07\User\Domain\Exceptions\EmptyUserSurnameException;
use Resolution07\User\Domain\Exceptions\InvalidEmailException;
use Resolution07\User\Domain\Exceptions\UserAlreadyExistsException;
use Resolution07\User\Domain\Exceptions\UserNotFoundException;
use Resolution07\User\Domain\Exceptions\UserReadException;
use Throwable;

class Handler
{
    #[ArrayShape(['message' => 'string', 'code' => 'int'])]
    public static function handle(Throwable $throwable): array
    {
        return match ($throwable::class) {
            CreateUserException::class => [
                'message' => 'Ошибка создания пользователя',
                'code' => 500
            ],
            EmptyUserLoginException::class => [
                'message' => 'Пустое поле `login`',
                'code' => 400
            ],
            InvalidEmailException::class => [
                'message' => 'Неверный формат email',
                'code' => 400
            ],
            EmptyUserNameException::class => [
                'message' => 'Пустое поле `name`',
                'code' => 400
            ],
            EmptyUserSurnameException::class => [
                'message' => 'Пустое поле `surname`',
                'code' => 400
            ],
            UserAlreadyExistsException::class => [
                'message' => 'Пользователь с таким логином уже существует',
                'code' => 400
            ],
            UserNotFoundException::class => [
                'message' => 'Пользователь с таким логином не существует',
                'code' => 404
            ],
            UserReadException::class => [
                'message' => 'Ошибка чтения пользователя',
                'code' => 500
            ],
            default => [
                'message' => 'Server error',
                'code' => 500
            ]
        };
    }
}
