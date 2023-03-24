<?php

namespace FireblocksSdkLaravel\Http;


use FireblocksSdkLaravel\Services\JwtService;

class SdkTokenProvider
{
    /**
     * @param string|array|OpenSSLAsymmetricKey|OpenSSLCertificate $private_key A string representation of your private key (in PEM format)
     * @param string $api_key Your api key. This is a uuid you received from Fireblocks
     */
    public function __construct($private_key, string $api_key)
    {
        $this->private_key = $private_key;
        $this->api_key     = $api_key;
    }

    public function signJwt(string $path, array $body_json = null): string
    {
        $timestamp_secs = time();
        $nonce          = (int)gmp_random_bits(63);

        $body_json = $body_json ?: "";

        $path    = str_replace("[", "%5B", $path);
        $path    = str_replace("]", "%5D", $path);
        $payload = [
            "uri"      => $path,
            "nonce"    => $nonce,
            "iat"      => $timestamp_secs,
            "exp"      => $timestamp_secs + 55,
            "sub"      => $this->api_key,
            "bodyHash" => hash('sha256', json_encode($body_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ];

        return JwtService::generateJwtRS256($payload, $this->private_key);
    }
}

