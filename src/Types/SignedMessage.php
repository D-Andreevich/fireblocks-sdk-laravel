<?php

namespace FireblocksSdkLaravel\Types;

class SignedMessage
{
    private string $content;   //	string	The message for signing (hex-formatted).
    private string $algorithm; //	string	The algorithm that was used for signing, one of the SigningAlgorithms.
    /**
     * @var int[]
     */
    private array  $derivationPath; //	Array of numbers	BIP32 derivation path of the signing key. E.g. [44,0,46,0,0].
    private array  $signature;      //	dictionary	The message signature.
    private string $publicKey;      //	string	Signature's public key that can be used for verification.

    /**
     * @param string $content
     * @param string $algorithm
     * @param int[] $derivationPath
     * @param array $signature
     * @param string $publicKey
     */
    public function __construct(string $content, string $algorithm, array $derivationPath, array $signature, string $publicKey)
    {
        $this->content        = $content;
        $this->algorithm      = $algorithm;
        $this->derivationPath = $derivationPath;
        $this->signature      = $signature;
        $this->publicKey      = $publicKey;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @return int[]
     */
    public function getDerivationPath(): array
    {
        return $this->derivationPath;
    }

    /**
     * @return array
     */
    public function getSignature(): array
    {
        return $this->signature;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

}