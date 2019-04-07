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
            'new_user_register' => array(
                '/api/user/register' => 'POST'
            ),
            'create_token' => array(
                '/api/user/token/create' => 'POST'
            ),
            'assign_role_to_user' => array(
                '/api/user/role/add' => 'POST'
            ),
            'remove_role_from_user' => array(
                '/api/user/role/remove' => 'DELETE'
            ),
            'make_role' => array(
                '/api/role/new' => 'POST'
            ),
            'delete_role' => array(
                '/api/role/delete' => 'DELETE'
            ),
            'new_client_register' => array(
                '/api/client/register' => 'POST'
            ),
            'get_user_settings' => array(
                '/api/user/settings' => 'GET'
            ),
            'get_public_key' => array(
                '/api/client/key' => 'POST'
            )
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
