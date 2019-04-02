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
            'new_user_register' => '/api/register/user',
            'create_token' => '/api/token/create',
            'assign_role_to_user' => '/api/user/role/add',
            'remove_role_from_user' => '/api/user/role/remove',
            'make_role' => '/api/role/new',
            'delete_role' => '/api/role/delete',
            'new_client_register' => '/api/register/client',
            'get_user_settings' => '/api/user/settings',
            'get_public_key' => '/api/client/key'
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
