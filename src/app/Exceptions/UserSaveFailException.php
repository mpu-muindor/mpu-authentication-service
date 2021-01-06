<?php

declare(strict_types=1);

namespace App\Exceptions;

use Sajya\Server\Exceptions\RpcException;

class UserSaveFailException extends RpcException
{
    protected function getDefaultCode(): int
    {
        return 1002;
    }

    protected function getDefaultMessage(): string
    {
        return 'User save is failed';
    }
}
