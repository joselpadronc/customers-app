<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (app()->environment('local')) {
            $log = [
                'URI' => $request->getUri(),
                'IP' => $request->ip(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $response->getContent()
            ];

            Log::channel('custom_debug')->info(json_encode($log));
        } else {
            $log = [
                'URI' => $request->getUri(),
                'IP' => $request->ip(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
            ];

            Log::channel('custom_debug')->info(json_encode($log));
        }

        return $response;
    }
}
