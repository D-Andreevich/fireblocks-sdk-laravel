<?php

namespace FireblocksSdkLaravel\Types\WebHook\Notifications;


class Notification
{
    //{
    //    "title": "User Logged In - ",
    //    "description": "Logged In",
    //    "userId": "eb9d07ee-9d75-1141-c750-9866e4362682",
    //    "createdAt": "Wed Feb 22 2023 14:21:49 GMT+0000 (Coordinated Universal Time)",
    //    "user": "Dev Team",
    //    "ip": "185.35.110.118",
    //    "email": "login@email.com",
    //    "eventKey": "login",
    //    "notificationSubject": "User Logged In",
    //    "workspace": "Name workspace"
    //}


    private string $title;
    private string $description;
    private string $userId;
    private string $createdAt;
    private string $user;
    private string $ip;
    private string $email;
    private string $eventKey;
    private string $notificationSubject;
    private string $workspace;

    public function __construct(string $title, string $description, string $userId, string $createdAt, string $user, string $ip, string $email, string $eventKey, string $notificationSubject, string $workspace)
    {
        $this->title               = $title;
        $this->description         = $description;
        $this->userId              = $userId;
        $this->createdAt           = $createdAt;
        $this->user                = $user;
        $this->ip                  = $ip;
        $this->email               = $email;
        $this->eventKey            = $eventKey;
        $this->notificationSubject = $notificationSubject;
        $this->workspace           = $workspace;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getEventKey(): string
    {
        return $this->eventKey;
    }

    /**
     * @return string
     */
    public function getNotificationSubject(): string
    {
        return $this->notificationSubject;
    }

    /**
     * @return string
     */
    public function getWorkspace(): string
    {
        return $this->workspace;
    }


}