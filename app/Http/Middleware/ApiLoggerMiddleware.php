<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiLoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $isMutation = in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE']);
        $isError = $response->getStatusCode() >= 400;

        if ($isMutation || $isError) {
            $this->logData($request, $response);
        }

        return $response;
    }

    protected function logData(Request $request, Response $response): void
    {
        Log::info("API Action Logged", [
            'user_id' => auth()->id() ?? 'guest',
            'method'  => $request->method(),
            'url'     => $request->fullUrl(),
            'status'  => $response->getStatusCode(),
            'payload' => $request->except(['password', 'password_confirmation']),
            'response' => $response->getStatusCode() >= 400
                ? json_decode($response->getContent(), true)
                : 'Successful mutation',
        ]);
    }
}
