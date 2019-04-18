<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 14:53
 */

namespace Rest\Domain\Entity\User;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class UserSettings
{
    private $id;
    private $userSettingsItems;
    private $user;
    private $appIdentifier;

    public function __construct(
        User $user,
        $appIdentifier
    )
    {
        $this->userSettingsItems = new ArrayCollection();
        $this->user = $user;
        $this->appIdentifier = $appIdentifier;
    }

    /**
     * @return PersistentCollection
     */
    public function getUserSettingsItems(): PersistentCollection
    {
        return $this->userSettingsItems;
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
    public function getAppIdentifier()
    {
        return $this->appIdentifier;
    }
}
