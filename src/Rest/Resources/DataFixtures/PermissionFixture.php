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
        );

        foreach ($arrayOfPermissions as $name => $array) {
            foreach ($array as $key => $value){
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
