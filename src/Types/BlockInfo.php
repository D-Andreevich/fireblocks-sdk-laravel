<?php

namespace FireblocksSdkLaravel\Types;

class BlockInfo
{
    private ?string $blockHeight; //		The height (number) of the block the transaction was mined in.
    private ?string $blockHash;   //		The hash of the block the transaction was mined in.

    public function __construct(?string $blockHeight, ?string $blockHash)
    {
        $this->blockHeight = $blockHeight;
        $this->blockHash   = $blockHash;
    }

    /**
     * @return string|null
     */
    public function getBlockHeight(): ?string
    {
        return $this->blockHeight;
    }

    /**
     * @return string|null
     */
    public function getBlockHash(): ?string
    {
        return $this->blockHash;
    }

}