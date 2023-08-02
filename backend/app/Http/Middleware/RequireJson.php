<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HTTP_Response;

class RequireJson
{
    /**
     * @param  Request  $request
     * @param  \Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        // クライアントでHTTPヘッダーにAccept：application/jsonを指定していないものは拒絶する
        if (! $request->expectsJson()) {
            abort(response()->json([
                'errors' => [
                    'code' => HTTP_Response::HTTP_UNSUPPORTED_MEDIA_TYPE,
                    'message' => '415 Unsupported Media Type',
                ]
            ], HTTP_Response::HTTP_UNSUPPORTED_MEDIA_TYPE));
        }

        return $next($request);
    }
}
