<?php

declare(strict_types=1);

namespace App\Exceptions;

use Sajya\Server\Exceptions\RpcException;

class UserNotFoundException extends RpcException
{
    protected function getDefaultCode(): int
    {
        return 1001;
    }

    protected function getDefaultMessage(): string
    {
        return 'User not found';
    }
}
