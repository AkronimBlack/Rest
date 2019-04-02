<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 17:56
 */

namespace Settings\Resources\DataFixtures;


use Settings\Domain\Entity\Permission;
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
            'make_role' => 'make_role',
            'delete_role' => 'delete_role',
            'get_user_settings' => 'get_user_settings'
        );

        foreach ($arrayOfPermissions as $key => $value) {
            $permission = new Permission(
                $key,
                $value
            );
            $this->setReference($key, $permission);
            $manager->persist($permission);
        }
        $manager->flush();
    }
}
