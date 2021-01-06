<?php

declare(strict_types=1);

namespace App\Exceptions;

use Sajya\Server\Exceptions\RpcException;

class PasswordInvalid extends RpcException
{
    protected function getDefaultCode(): int
    {
        return 1003;
    }

    protected function getDefaultMessage(): string
    {
        return 'Password invalid';
    }
}
