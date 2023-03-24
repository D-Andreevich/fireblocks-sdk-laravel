<?php

namespace FireblocksSdkLaravel\Http\Middlewares;


use Closure;
use FireblocksSdkLaravel\Exceptions\FireblocksApiException;
use FireblocksSdkLaravel\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationMiddleware
{
    /**
     * @throws FireblocksApiException
     */
    public function handle($request, Closure $next)
    {
        if ($this->jwt_is_valid($request)) {
            return $next($request);
        }

        return response()->json(['message' => 'Invalid Secret'], 403);
    }

    /**
     * @throws FireblocksApiException
     */
    protected function jwt_is_valid(Request $request): bool
    {
        $jwt    = $request->header("X-Webhook-Secret");
        $config = config('fireblocks');
        if (empty($config['x_webhook_secret'])) {
            throw new FireblocksApiException('File not exists by [x_webhook_secret], please check config');
        }
        try {
            return JwtService::validateJwt($jwt, $config['x_webhook_secret']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), ['file' => $exception->getFile(), 'line' => $exception->getLine()]);
            return false;
        }
    }
}