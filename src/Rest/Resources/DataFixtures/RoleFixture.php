<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 23.01.2019
 * Time: 15:20
 */

namespace Rest\Resources\DataFixtures;


use Rest\Domain\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rest\Domain\Entity\Role;

class RoleFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $permissionRepo = $manager->getRepository(Permission::class);
        $roles = array(
            'ROLE_USER'  => array(
                'name'       => 'User',
                'permission' => array(
                    'get_user_settings',
                ),
            ),
            'ROLE_ADMIN' => array(
                'name'       => 'Admin',
                'permission' => array(
                    'get_user_settings',
                    'add_permission_to_role',
                    'view_all_roles',
                    'view_permissions_for_role',
                    'create_role',
                    'delete_role',
                    'edit_role',
                    'view_all_permissions',
                    'extend_role',
                    'view_extended_roles'
                ),
            )
        );
        foreach ($roles as $roleRef => $specs) {
            $role = new Role(
                $roleRef,
                $specs['name']
            );
            $this->setReference($role->getName(), $role);
            foreach ($specs['permission'] as $permissionName){
                /** @var Permission $permission */
                $permission = $permissionRepo->findByName($permissionName);
                $role->addPermission($permission);
            }
            $manager->persist($role);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            PermissionFixture::class,
        );
    }
}
