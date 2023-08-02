<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Domains\Auth\Domain\Exceptions\UserUnauthorizedException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return JsonResponse|null
     */
    protected function redirectTo($request): JsonResponse|null
    {
        $error = new UserUnauthorizedException();
        abort(response()->json([
            'errors' => [
                'code' => $error->getCode(),
                'message' => $error->getMessage(),
            ],
        ], $error->getCode()));
    }
}
