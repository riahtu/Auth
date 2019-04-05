<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 27.03.2019
 * Time: 13:24
 */

namespace Authentication\Resources\DataFixtures;


use Authentication\Domain\Entity\Client\Client;
use Authentication\Domain\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ClientFixture extends Fixture implements DependentFixtureInterface
{
    const CLIENT_NAME = 'Test';
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $roleRepository = $manager->getRepository(Role::class);
        $role = $roleRepository->findByReference(Role::ROLE_CLIENT);
        $client = new Client(
            self::CLIENT_NAME,
            self::CLIENT_NAME
        );
        $client->addRole($role);
        $this->setReference(self::CLIENT_NAME, $client->getLastActiveAccessToken());
        $manager->persist($client);
        $manager->flush();
    }
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return array(
            RoleFixture::class
        );
    }

}
