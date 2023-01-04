<?php

namespace FireblocksSdkLaravel\Http;

use FireblocksSdkLaravel\Exceptions\FireblocksApiException;
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
        $this->timeout        = $timeout;
        $this->api_key        = $api_key;
        $this->base_url       = $api_base_url;
        $this->tokenProvider = new SdkTokenProvider($private_key, $api_key);
    }

    /**
     * @param string $path
     * @param $page_mode
     * @param array|null $query_params
     * @return array|mixed|null
     * @throws FireblocksApiException
     */
    public function get_request(string $path, $page_mode = False, array $query_params = null)
    {
        if ($query_params){
            $path = $path . "?" .  http_build_query($query_params);
        }

        $token = $this->tokenProvider->signJwt($path);

        $headers = [
            "X-API-Key"     => $this->api_key,
            "Authorization" => "Bearer {$token}",
        ];

        $response = Http::timeout($this->timeout)->withHeaders($headers)->get($this->base_url.$path);
        return $this->handle_response($response, $page_mode);
    }

    /**
     * @param string $path
     * @param $page_mode
     * @param array|null $query_params
     * @return array|mixed|null
     * @throws FireblocksApiException
     */
    public function delete_request(string $path)
    {
        $token = $this->tokenProvider->signJwt($path);

        $headers = [
            "X-API-Key"     => $this->api_key,
            "Authorization" => "Bearer {$token}",
        ];

        $response = Http::timeout($this->timeout)->withHeaders($headers)->delete($this->base_url.$path);
        return $this->handle_response($response);
    }

    public function post_request(string $path, array $body=[], $idempotency_key=null){
        $token = $this->tokenProvider->signJwt($path, $body);
        if (!$idempotency_key) {
            $headers = [
                "X-API-Key"     => $this->api_key,
                "Authorization" => "Bearer {$token}",
            ];
        }else{
            $headers = [
                "X-API-Key" => $this->api_key,
                "Authorization" => "Bearer {$token}",
                "Idempotency-Key" => $idempotency_key
            ];
        }

        $response = Http::timeout($this->timeout)->withHeaders($headers)->post($this->base_url . $path, $body);
        return $this->handle_response($response);
    }

    public function put_request(string $path, array $body=[]){
        $token = $this->tokenProvider->signJwt($path, $body);
        $headers = [
            "X-API-Key" => $this->api_key,
            "Authorization" => "Bearer {$token}",
            "Content-Type" => "application/json",
        ];

        $response = Http::timeout($this->timeout)->withHeaders($headers)->put($this->base_url . $path, $body);
        return $this->handle_response($response);
    }
    public function patch_request(string $path, array $body=[]){
        $token = $this->tokenProvider->signJwt($path, $body);
        $headers = [
            "X-API-Key" => $this->api_key,
            "Authorization" => "Bearer {$token}",
            "Content-Type" => "application/json",
        ];

        $response = Http::timeout($this->timeout)->withHeaders($headers)->patch($this->base_url . $path, $body);
        return $this->handle_response($response);
    }

    private function handle_response(Response $response, $page_mode = False)
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
        } else {
            if ($page_mode) {
                return [
                    'transactions' => $response_data,
                    'pageDetails'  => [
                        'prevPage' => $response->header('prev-page'),
                        'nextPage' => $response->header('next-page'),
                    ]
                ];
            }
            return $response_data;
        }
    }
}