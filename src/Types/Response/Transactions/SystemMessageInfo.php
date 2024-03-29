<?php

namespace FireblocksSdkLaravel\Types\Response\Transactions;

class SystemMessageInfo
{
    private string $type; //	[ WARN , BLOCK ] The type of system message being returned.
    private string $message; //	In plain text, the specific message being returned from the system about its status. (Example: "The asset's blockchain is experiencing intermittent delays, therefore outgoing transactions might get stuck.")

    /**
     * @param string $type
     * @param string $message
     */
    public function __construct(string $type, string $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}