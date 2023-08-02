<?php

declare(strict_types=1);

namespace App\Domains\Auth\Domain\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserUnauthorizedException extends Exception
{
    public function __construct(string $message = '401 User Unauthorized', int $code = Response::HTTP_UNAUTHORIZED)
    {
        parent::__construct($message, $code);
    }
}
