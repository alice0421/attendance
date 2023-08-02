<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends Exception
{
    public function __construct(string $message = '404 User Not Found', int $code = Response::HTTP_NOT_FOUND)
    {
        parent::__construct($message, $code);
    }
}
