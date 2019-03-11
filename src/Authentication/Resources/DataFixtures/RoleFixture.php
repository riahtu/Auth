<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 23.01.2019
 * Time: 15:20
 */

namespace Authentication\Resources\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Authentication\Domain\Entity\Role;

class RoleFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $roles = array(
            'ROLE_USER'  => array(
                'name'       => 'User',
                'permission' => array(
                    'make api token',
                    'create_jwt_token'
                ),
            ),
            'ROLE_ADMIN' => array(
                'name'       => 'Admin',
                'permission' => array(
                    'view_users_agreements',
                    'assign_role_to_user',
                    'remove_role_from_user',
                    'view_data_collections_of_users',
                    'get_user_data_collection',
                    'make_role',
                    'delete_role',
                    'assign_contract_to_role',
                    'create_new_contract',
                    'assign_permission_to_role'
                ),
            ),
            'ROLE_ANON'  => array(
                'name'       => 'Anon',
                'permission' => array(
                    'new_user_register',
//                    'create_jwt_token',
                    'check_jwt_token'
                ),
            ),
        );
        foreach ($roles as $roleRef => $specs) {
            $role = new Role(
                $roleRef,
                $specs['name']
            );
            $this->setReference($role->getName(), $role);
            $manager->persist($role);
        }
        $manager->flush();
    }
}
