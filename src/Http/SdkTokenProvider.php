<?php

namespace FireblocksSdkLaravel\Http;



class SdkTokenProvider
{
    /**
     * @param  string|array|OpenSSLAsymmetricKey|OpenSSLCertificate $private_key A string representation of your private key (in PEM format)
     * @param string $api_key Your api key. This is a uuid you received from Fireblocks
     */
    public function __construct($private_key, string $api_key)
    {
        $this->private_key = $private_key;
        $this->api_key = $api_key;
    }

    public function signJwt(string $path, array $body_json=null){
        $timestamp_secs = time();
        $nonce = (int)gmp_random_bits(63);

        $body_json = $body_json ?: "";

        $path= str_replace("[", "%5B", $path);
        $path= str_replace("]", "%5D", $path);
        $payload = [
            "uri" => $path,
            "nonce" => $nonce,
            "iat" => $timestamp_secs,
            "exp" => $timestamp_secs + 55,
            "sub" => $this->api_key,
            "bodyHash" => hash('sha256',json_encode($body_json,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES))
        ];

        return $this->generateJwtRS256($payload, $this->private_key);
    }

    /**
     * Use algorithm RS256
     * @param array $payload
     * @param string $private_key
     * @return string
     */
    private function generateJwtRS256 (array $payload, $private_key){
        $headerJson = json_encode([
            'alg' => 'RS256',
            'typ' => 'JWT',
        ],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        $payloadJson = json_encode($payload,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

        $base64UrlHeader = $this->base64UrlEncode($headerJson);
        $base64UrlPayload = $this->base64UrlEncode($payloadJson);

        openssl_sign(
            "$base64UrlHeader.$base64UrlPayload",
            $signature,
            $private_key,
            "sha256WithRSAEncryption"
        );

        $base64UrlSignature = $this->base64UrlEncode($signature);
        $jwt = "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";

        return  $jwt;
    }

    private function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}