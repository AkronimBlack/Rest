<?php

namespace Rest\Application\Service\User;


use Rest\Domain\Entity\User\User;

class ViewUserSettingsRequest
{
    /**
     * @var User
     */
    private $user;
    private $appId;

    public function __construct(
        User $user,
        $appId
    )
    {
        $this->user = $user;
        $this->appId = $appId;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }
}
