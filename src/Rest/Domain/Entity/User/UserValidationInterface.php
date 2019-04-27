<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 13:06
 */

namespace Rest\Domain\Entity\User;


interface UserValidationInterface
{
    public function getUsername();
    public function getRoles();
    public function hasPermission($route , $method);
}
