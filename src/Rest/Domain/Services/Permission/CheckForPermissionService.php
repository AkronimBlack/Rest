<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 20-Jan-19
 * Time: 9:33
 */

namespace Rest\Domain\Services\Permission;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\User\UserValidationInterface;
use Rest\Domain\Services\Exceptions\UserDoesntHavePermissionException;

class CheckForPermissionService
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param UserValidationInterface $user
     * @param $route
     * @param $method
     */
    public function execute(
        UserValidationInterface $user,
        $route,
        $method
    ): void
    {
        $permission = $user->hasPermission($route , $method);
        if(!$permission){
            throw new UserDoesntHavePermissionException(['username' => $user->getUsername()]);
        }
    }
}
