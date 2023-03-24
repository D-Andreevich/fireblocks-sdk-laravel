<?php

namespace FireblocksSdkLaravel\Types\Response\Vault;

use FireblocksSdkLaravel\Types\Enums\SigningAlgorithmEnums;

class PublicKey
{
    private string $publicKey;    //	The requested public key.
    private SigningAlgorithmEnums $algorithm;    //	One of the SigningAlgorithms.
    /**
     * @var int[]
     */
    private array $derivationPath;    // of numbers	For BIP32 derivation used to retrieve the public key.

    /**
     * @param string $publicKey
     * @param string $algorithm
     * @param int[] $derivationPath
     */
    public function __construct(string $publicKey, string $algorithm, array $derivationPath)
    {
        $this->publicKey = $publicKey;
        $this->algorithm = SigningAlgorithmEnums::{$algorithm}();
        $this->derivationPath = $derivationPath;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @return SigningAlgorithmEnums
     */
    public function getAlgorithm(): SigningAlgorithmEnums
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

}