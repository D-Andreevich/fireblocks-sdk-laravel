<?php

namespace FireblocksSdkLaravel\Http\Middlewares;


use Closure;
use FireblocksSdkLaravel\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($this->signature_is_valid($request)) {
            return $next($request);
        }

        return response()->json(['message' => 'Invalid signature'], 403);
    }

    protected function signature_is_valid(Request $request): bool
    {
        $body      = $request->getContent();
        $signature = $request->header("Fireblocks-Signature");
        try {
            return JwtService::validateContentBySignature($body, $signature);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), ['file' => $exception->getFile(), 'line' => $exception->getLine()]);
            return false;
        }

    }
}