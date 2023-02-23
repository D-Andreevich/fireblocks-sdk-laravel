<?php

namespace FireblocksSdkLaravel\Types;

class UnsignedMessage
{
    /**
     * Defines message to be signed by raw transaction
     * @param string $content The message to be signed in hex format encoding
     * @param int|float|string |null $bip44addressIndex  BIP44 address_index path level
     * @param int|float|string |null $bip44change BIP44 change path level
     * @param array|null $derivationPath (list of numbers, optional): Should be passed only if asset and source were not specified [44,0,0,0,0]
     */
    public function __construct(string$content,string $bip44addressIndex=null,string $bip44change=null,array $derivationPath=null){
        $this->content = $content;

        if ($bip44addressIndex)
            $this->bip44addressIndex = $bip44addressIndex;

        if ($bip44change)
            $this->bip44change = $bip44change;

        if ($derivationPath)
            $this->derivationPath = $derivationPath;
    }

    /**
     * @return float|int|string
     */
    public function getBip44addressIndex()
    {
        return $this->bip44addressIndex;
    }

    /**
     * @return float|int|string
     */
    public function getBip44change()
    {
        return $this->bip44change;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return array<int>
     */
    public function getDerivationPath(): array
    {
        return $this->derivationPath;
    }

}