<?php

namespace FireblocksSdkLaravel\Types;

class AuthorizationInfo
{
    private bool   $allowOperatorAsAuthorizer;    //	Set to "true" if the intiator of the transaction can be one of the approvers.
    private string $logic;                        //	"AND" or "OR", this is the logic that is applied between the different authorization groups listed below.
    private array  $groups;                       //List of AuthorizationGroups	The list of authorization groups and users that are required to approve this transaction. The logic applied between the different groups is the “logic” field above. Each element in the response is the user ID (the can found see via the users endpoint) and their ApprovalStatus.

    public function __construct(bool $allowOperatorAsAuthorizer, string $logic, array $groups)
    {
        $this->allowOperatorAsAuthorizer = $allowOperatorAsAuthorizer;
        $this->logic                     = $logic;
        foreach ($groups as $group) {
            $this->groups[] = new AuthorizationGroup(...$group);
        }
    }

    /**
     * @return bool
     */
    public function isAllowOperatorAsAuthorizer(): bool
    {
        return $this->allowOperatorAsAuthorizer;
    }

    /**
     * @return string
     */
    public function getLogic(): string
    {
        return $this->logic;
    }

    /**
     * @return array<AuthorizationGroup>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }


}