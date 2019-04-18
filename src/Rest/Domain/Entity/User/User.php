<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Dec-18
 * Time: 19:20
 */

namespace Rest\Domain\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface , UserValidationInterface
{

    private $id;
    private $username;
    private $roles;
    private $settings;

    /**
     *
     * @param $username
     * @param $roles
     */

    public function __construct(
        $username,
        $roles
    )
    {
        $this->username = $username;
        $this->roles = $roles;

        $this->settings = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles(): array
    {
        $roleArray = array();
        /**
         * @var Role $role
         */
        foreach ($this->roles as $role){
            $roleArray[] = $role->getRole();
        }
        return array_unique($roleArray);
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function hasPermission($route)
    {

        /**@var Role $role */
        foreach ($this->roles as $role){
            $check = $role->hasPermission($route);
            if($check){
                return $check;
            }
        }
        return false;
    }

    /**
     * @return ArrayCollection
     */
    public function getSettings(): ArrayCollection
    {
        return $this->settings;
    }
}
