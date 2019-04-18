<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Dec-18
 * Time: 19:20
 */

namespace Rest\Domain\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;

class User
{

    private $id;
    private $identifier;
    private $settings;

    public function __construct(
        $identifier
    )
    {
        $this->settings = new ArrayCollection();
        $this->identifier = $identifier;
    }

    /**
     * @param UserSettings $settings
     */
    public function addSettings(UserSettings $settings): void
    {
        $this->settings[] = $settings;
    }

    /**
     * @return ArrayCollection
     */
    public function getSettings(): ArrayCollection
    {
        return $this->settings;
    }

    public function getSettingsForApp($appId)
    {
        /**
         * @var UserSettings $settings
         */
        foreach ($this->getSettings() as $settings)
        {
            if($settings->getAppIdentifier() === $appId){
                return $settings;
            }
            return false;
        }
    }

    /**
     * @param mixed $identifier
     *
     * @return User
     */
    public function setIdentifier($identifier): User
    {
        $this->identifier = $identifier;

        return $this;
}

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
