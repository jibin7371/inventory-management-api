<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestTime
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true);

        $response = $next($request);

        $duration = microtime(true) - $start;

        // Log::info('API Request', [
        //     'endpoint' => $request->path(),
        //     'duration' => $duration
        // ]);

        Log::channel('api_requests')->info('API Request', [
            'endpoint' => $request->path(),
            'method' => $request->method(),
            'duration' => round($duration, 4) . ' sec',
        ]);

        return $response;
    }
}
