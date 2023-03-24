<?php

namespace FireblocksSdkLaravel\Http;

use FireblocksSdkLaravel\Exceptions\FireblocksApiException;
use FireblocksSdkLaravel\Types\Response\Base\PaginateResponseData;
use FireblocksSdkLaravel\Types\Response\Base\ResponseData;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FireblocksApiClient
{
    /**
     * @param string|array|OpenSSLAsymmetricKey|OpenSSLCertificate $private_key
     * @param string $api_key
     * @param string $api_base_url
     * @param int $timeout
     */
    public function __construct($private_key, string $api_key, string $api_base_url, int $timeout)
    {
        $this->timeout = $timeout;
        $this->api_key = $api_key;
        $this->base_url = $api_base_url;
        $this->tokenProvider = new SdkTokenProvider($private_key, $api_key);
    }

    /**
     * @throws FireblocksApiException
     */
    public function get_request_paginate(string $path, array $query_params = null): PaginateResponseData
    {
        return $this->handle_response_paginate($this->base_get_request($path, $query_params));
    }

    /**
     * @throws FireblocksApiException
     */
    private function handle_response_paginate(Response $response): PaginateResponseData
    {
        return new PaginateResponseData(...[
            'data' => $this->check_response($response),
            'pageDetails' => [
                'prevPage' => $response->header('prev-page'),
                'nextPage' => $response->header('next-page'),
            ]
        ]);
    }

    /**
     * @throws FireblocksApiException
     */
    private function check_response(Response $response)
    {
        try {
            $response_data = $response->json();
        } catch (\Exception $exception) {
            $response_data = null;
        }

        if ($response->status() >= 300) {
            if ($response_data && isset($response_data["code"])) {
                $error_code = $response_data["code"];
                throw  new FireblocksApiException("Got an error from fireblocks server: " . $response->body(), $error_code);
            } else {
                throw new FireblocksApiException("Got an error from fireblocks server: " . $response->body());
            }
        }
        return $response_data;
    }

    private function base_get_request(string $path, array $query_params = null)
    {
        if ($query_params) {
            $path = $path . "?" . http_build_query($query_params);
        }

        return Http::timeout($this->timeout)->withHeaders($this->get_headers($path))->get($this->base_url . $path);
    }

    private function get_headers(string $path, array $body = null, string $idempotency_key = null): array
    {
        $token = $this->tokenProvider->signJwt($path, $body);

        $headers = [
            "X-API-Key" => $this->api_key,
            "Authorization" => "Bearer {$token}",
            "Content-Type" => "application/json",
        ];
        if ($idempotency_key) {
            $headers["Idempotency-Key"] = $idempotency_key;
        }

        return $headers;
    }

    /**
     * @throws FireblocksApiException
     */
    public function get_request(string $path, array $query_params = null): ResponseData
    {
        return $this->handle_response($this->base_get_request($path, $query_params));
    }

    /**
     * @throws FireblocksApiException
     */
    private function handle_response(Response $response): ResponseData
    {
        return new ResponseData($this->check_response($response));
    }

    /**
     * @param string $path
     * @return ResponseData
     * @throws FireblocksApiException
     */
    public function delete_request(string $path): ResponseData
    {
        $response = Http::timeout($this->timeout)->withHeaders($this->get_headers($path))->delete($this->base_url . $path);
        return $this->handle_response($response);
    }

    /**
     * @throws FireblocksApiException
     */
    public function post_request(string $path, array $body = [], string $idempotency_key = null): ResponseData
    {
        $response = Http::timeout($this->timeout)->withHeaders($this->get_headers($path, $body, $idempotency_key))->post($this->base_url . $path, $body);
        return $this->handle_response($response);
    }

    /**
     * @throws FireblocksApiException
     */
    public function put_request(string $path, array $body = []): ResponseData
    {
        $response = Http::timeout($this->timeout)->withHeaders($this->get_headers($path, $body))->put($this->base_url . $path, $body);
        return $this->handle_response($response);
    }

    /**
     * @throws FireblocksApiException
     */
    public function patch_request(string $path, array $body = []): ResponseData
    {
        $response = Http::timeout($this->timeout)->withHeaders($this->get_headers($path, $body))->patch($this->base_url . $path, $body);
        return $this->handle_response($response);
    }
}