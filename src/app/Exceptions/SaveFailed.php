<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class SaveFailed extends HttpException
{
    /**
     * @param string|null $message
     * @param \Throwable|null $previous
     * @param array $headers
     * @param int $code
     * @return void
     */
    public function __construct($message = null, \Throwable $previous = null, array $headers = [], $code = 0)
    {
        parent::__construct(500, $message, $previous, $headers, $code);
    }
}
