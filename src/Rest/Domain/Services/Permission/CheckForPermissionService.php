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
     * @param $user
     * @param $route
     *
     */
    public function execute(
        UserValidationInterface $user,
        $route
    ): void
    {
        $permission = $user->hasPermission($route);
        if(!$permission){
            throw new UserDoesntHavePermissionException(['username' => $user->getUsername()]);
        }
    }
}
