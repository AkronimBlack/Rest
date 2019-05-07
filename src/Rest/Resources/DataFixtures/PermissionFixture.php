<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 17:56
 */

namespace Rest\Resources\DataFixtures;


use Rest\Domain\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PermissionFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $arrayOfPermissions = array(
            'get_user_settings'         => array(
                '/user/settings' => 'GET',
            ),
            'add_permission_to_role'    => array(
                '/api/role/permission' => 'POST',
            ),
            'view_all_roles'            => array(
                '/api/roles' => 'GET',
            ),
            'view_permissions_for_role' => array(
                '/api/role/permissions' => 'GET',
            ),
            'create_role'               => array(
                '/api/role' => 'POST',
            ),
            'delete_role'               => array(
                '/api/role' => 'DELETE',
            ),
            'edit_role'                 => array(
                '/api/role' => 'PUT',
            ),
            'view_all_permissions'      => array(
                '/api/permissions' => 'GET',
            ),
            'extend_role'      => array(
                '/api/role/extend' => 'PUT',
            ),

        );

        foreach ($arrayOfPermissions as $name => $array) {
            foreach ($array as $key => $value) {
                $permission = new Permission(
                    $name,
                    $key,
                    $value
                );
                $this->setReference($key, $permission);
                $manager->persist($permission);
            }
        }
        $manager->flush();
    }
}
