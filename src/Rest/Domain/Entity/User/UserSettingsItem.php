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
    private $name;
    private $value;
    private $userSettings;

    public function __construct(
        $name,
        $value
    )
    {
        $this->name = $name;
        $this->value = $value;
        $this->userSettings = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
