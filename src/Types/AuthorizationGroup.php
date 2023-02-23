<?php

namespace FireblocksSdkLaravel\Types;

class AuthorizationGroup
{
    private int   $th;    //	The threshold of required approvers in this authorization group.
    private array $users; //	list of users	The list of users that the threshold number is applied to for transaction approval. Each user in the response is a "key:value" where the key is the user ID (the can found see via the users endpoint) and the value is their ApprovalStatus.

    public function __construct(int $th, array $users)
    {
        $this->th    = $th;
        $this->users = $users;
    }

    /**
     * @return int
     */
    public function getTh(): int
    {
        return $this->th;
    }

    /**
     * @return array<['key'=>'value']>
     */
    public function getUsers(): array
    {
        return $this->users;
    }

}