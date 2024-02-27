<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        try {
            $response = $next($request);
        } catch (ThrottleRequestsException $exception) {
            $response = new JsonResponse([
                'message' => 'Too Many Requests',
            ],Response::HTTP_TOO_MANY_REQUESTS);
            Log::channel('api_log')->warning('API Response:',[
                'date' => now()->toDateTimeString(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'parameters' => $request->all(),
                'headers' => $request->header('User-Agent'),
                'ip_address' => $request->ip()
            ]);
        }

        $endTime = microtime(true);
        $excuteTime = round(($startTime - $endTime) * 1000,2);

        Log::channel('api_log')->info('Api Request:',[
            'date' => now()->toDateTimeString(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'parameters' => $request->all(),
            'headers' =>  $request->header('User-Agent'),
            'ip_address' => $request->ip(),
            'execute_time' => $excuteTime . ' ms',
        ]);

        if($response instanceof JsonResponse) {
            if($response->getStatusCode() >= 200 && $response->getStatusCode() < 300){
                Log::channel('api_log')->info('API Response',[
                    'status_code' => $response->getStatusCode(),
                    'content' => $response->getContent(),
                    'execute_time' => $excuteTime . ' ms'
                ]);
            }else{
                Log::channel('api_log')->error('API Response',[
                    'status_code' => $response->getStatusCode(),
                    'content' => $response->getContent(),
                    'execute_time' => $excuteTime . ' ms'
                ]);
            }
        }
        return $response;
    }
}
