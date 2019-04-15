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

class UserSettingsItem
{
    private $userSettingsItem;

    public function __construct()
    {
        $this->userSettingsItem = new ArrayCollection();
    }

    /**
     * @return PersistentCollection
     */
    public function getUserSettingsItem(): PersistentCollection
    {
        return $this->userSettingsItem;
    }
}
