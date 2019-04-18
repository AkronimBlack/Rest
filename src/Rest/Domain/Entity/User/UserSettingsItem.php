<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 14:53
 */

namespace Rest\Domain\Entity\User;


use Doctrine\Common\Collections\ArrayCollection;

class UserSettingsItem
{
    private $id;
    private $identifier;
    private $value;
    private $userSettings;

    public function __construct(
        $identifier,
        $value
    )
    {
        $this->identifier = $identifier;
        $this->value = $value;
        $this->userSettings = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return ArrayCollection
     */
    public function getUserSettings(): ArrayCollection
    {
        return $this->userSettings;
    }
}
