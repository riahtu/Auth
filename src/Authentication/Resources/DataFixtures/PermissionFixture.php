<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 17:56
 */

namespace Authentication\Resources\DataFixtures;


use Authentication\Domain\Entity\Permission;
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
            'new_user_register' => 'new_user_register',
            'create_token' => 'create_token',
            'assign_role_to_user' => 'assign_role_to_user',
            'remove_role_from_user' => 'remove_role_from_user',
            'make_role' => 'make_role',
            'delete_role' => 'delete_role',
            'new_client_register' => 'new_client_register',
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
