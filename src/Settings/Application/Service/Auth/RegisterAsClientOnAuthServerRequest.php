<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 13:15
 */

namespace Settings\Application\Service\Auth;


class RegisterAsClientOnAuthServerRequest
{
    private $username;
    private $password;

    /**
     * RegisterAsClientOnAuthServerRequest constructor.
     *
     * @param $username
     * @param $password
     */
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}
