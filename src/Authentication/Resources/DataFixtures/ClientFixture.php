<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 27.03.2019
 * Time: 13:24
 */

namespace Authentication\Resources\DataFixtures;


use Authentication\Domain\Entity\Client\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClientFixture extends Fixture
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
        $client = new Client(
            self::CLIENT_NAME,
            self::CLIENT_NAME
        );

        $this->setReference(self::CLIENT_NAME, $client->getLastActiveAccessToken());
        $manager->persist($client);
        $manager->flush();
    }
}
