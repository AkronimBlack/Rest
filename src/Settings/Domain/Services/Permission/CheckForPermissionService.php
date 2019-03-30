<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 20-Jan-19
 * Time: 9:33
 */

namespace Settings\Domain\Services\Permission;


use Doctrine\ORM\EntityManagerInterface;
use Settings\Domain\Entity\Role;
use Settings\Domain\Entity\User;
use Settings\Domain\Services\Exceptions\UserDoesntHavePermissionException;

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
        $user,
        $route
    ): void
    {
        if($user instanceof User){
            $permission = $user->hasPermission($route);
            if(!$permission){
                throw new UserDoesntHavePermissionException(['username' => $user->getUsername()]);
            }
        }else{
            $role = $this->em->getRepository(Role::class)->findByReference(Role::ANON_ROLE);
            $permission = $role->hasPermission($route);
            if(!$permission){
                throw new UserDoesntHavePermissionException(['username' => 'Anon']);
            }
        }
    }
}
