<?php

namespace FireblocksSdkLaravel\Services;

use FireblocksSdkLaravel\Exceptions\FireblocksApiException;

class JwtService
{
    /**
     * Use algorithm RS256
     * @param array $payload
     * @param string $private_key
     * @return string
     */
    public static function generateJwtRS256(array $payload, string $private_key): string
    {
        $headerJson  = json_encode([
            'alg' => 'RS256',
            'typ' => 'JWT',
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $payloadJson = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $base64UrlHeader  = self::base64UrlEncode($headerJson);
        $base64UrlPayload = self::base64UrlEncode($payloadJson);

        openssl_sign(
            "$base64UrlHeader.$base64UrlPayload",
            $signature,
            $private_key,
            "sha256WithRSAEncryption"
        );

        $base64UrlSignature = self::base64UrlEncode($signature);
        $jwt                = "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";

        return $jwt;
    }

    private static function base64UrlEncode($data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * @throws FireblocksApiException
     */
    public static function validateJwt(string $jwt, string $secret = 'secret'): bool
    {
        // split the jwt
        $tokenParts = explode('.', $jwt);
        if (count($tokenParts) !== 3) {
            throw new FireblocksApiException('Invalid JWT');
        }
        $header             = base64_decode($tokenParts[0]);
        $payload            = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        // check the expiration time
        if (!isset(json_decode($payload)->exp)) {
            throw new FireblocksApiException('Invalid JWT: not exist variable [exp] (expired)');
        }
        $expiration       = json_decode($payload)->exp;
        $is_token_expired = ($expiration - time()) < 0;

        // build a signature based on the header and payload using the secret
        $base64_url_header    = self::base64UrlEncode($header);
        $base64_url_payload   = self::base64UrlEncode($payload);
        $signature            = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = self::base64UrlEncode($signature);

        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);

        if ($is_token_expired || !$is_signature_valid) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @throws FireblocksApiException
     */
    public static function validateContentBySignature(string $body, string $signature): bool
    {
        $config = config('fireblocks');
        if (!file_exists($config['public_api_key_path'])) {
            throw new FireblocksApiException('File not exists by [public_api_key_path], please check config');
        }
        $pubKey = file_get_contents($config['public_api_key_path']);
        return (openssl_verify($body, base64_decode($signature), $pubKey, OPENSSL_ALGO_SHA512) === 1);
    }
}