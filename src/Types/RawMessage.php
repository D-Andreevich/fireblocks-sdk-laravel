<?php

namespace DAndreevich\FireblocksSdkLaravel\Types;

use DAndreevich\FireblocksSdkLaravel\Exceptions\FireblocksApiException;
use DAndreevich\FireblocksSdkLaravel\Types\Enums\SigningAlgorithmEnums;

class RawMessage
{
    /**
     * Defines raw message
     * @param array $messages list of UnsignedMessage
     * @param SigningAlgorithmEnums|null $algorithm
     * @throws FireblocksApiException
     */
    public function __construct(array $messages,SigningAlgorithmEnums $algorithm=null)
    {

        $this->messages = [];
        foreach ($messages as $item){
            if (!($item instanceof UnsignedMessage)) {
                throw new FireblocksApiException("Expected messages of type array UnsignedMessage");
            }
            $this->messages[] = get_object_vars($item);
        }

        if ($algorithm)
            $this->algorithm = (string)$algorithm;
    }

}