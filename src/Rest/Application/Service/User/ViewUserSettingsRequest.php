<?php

namespace Rest\Application\Service\User;


use Rest\Infrastructure\Domain\User\ValidatedUser;

class ViewUserSettingsRequest
{
    private $appId;
    /**
     * @var ValidatedUser
     */
    private $validatedUser;

    public function __construct(
        ValidatedUser $validatedUser,
        $appId
    )
    {
        $this->appId = $appId;
        $this->validatedUser = $validatedUser;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return ValidatedUser
     */
    public function getValidatedUser(): ValidatedUser
    {
        return $this->validatedUser;
    }
}
