<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 04-Apr-19
 * Time: 18:54
 */

namespace Settings\Application\Service\Auth;

class GetPublicKeyFromAuthRequest
{
    private $username;
    private $password;

    public function __construct(
        $username,
        $password
    ) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

}
