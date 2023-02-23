<?php

namespace FireblocksSdkLaravel\Types;

class RewardsInfo
{
    private string $srcRewards;     //	The ALGO rewards acknowledged by the source account of the transaction.
    private string $destRewards;    //	The ALGO rewards acknowledged by the destination account of the transaction.

    public function __construct(string $srcRewards, string $destRewards)
    {
        $this->srcRewards  = $srcRewards;
        $this->destRewards = $destRewards;
    }

    /**
     * @return string
     */
    public function getSrcRewards(): string
    {
        return $this->srcRewards;
    }

    /**
     * @return string
     */
    public function getDestRewards(): string
    {
        return $this->destRewards;
    }


}