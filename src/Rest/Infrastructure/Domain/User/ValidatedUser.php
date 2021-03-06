<?php


namespace Rest\Infrastructure\Domain\User;


use Rest\Domain\Entity\Role;
use Rest\Domain\Entity\User\UserValidationInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ValidatedUser implements UserInterface , UserValidationInterface
{
    private $username;
    private $roles;
    private $uid;

    /**
     * ValidatedUser constructor.
     *
     * @param $username
     * @param $roles
     * @param $uid
     */
    public function __construct(
        $username,
        $roles,
        $uid
    )
    {
        $this->username = $username;
        $this->roles = $roles;
        $this->uid = $uid;
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
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
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

    public function hasPermission($route , $method)
    {
        /**@var Role $role */
        foreach ($this->roles as $role){
            $check = $role->hasPermission($route , $method);
            if($check){
                return $check;
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }
}
