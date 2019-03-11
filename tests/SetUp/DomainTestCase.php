<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 11-Feb-19
 * Time: 21:15
 */

namespace App\Tests\SetUp;



use Liip\FunctionalTestBundle\Test\WebTestCase;
use Authentication\Domain\Entity\User;
use Authentication\Resources\DataFixtures\UserFixtures;
use Symfony\Bundle\FrameworkBundle\Client;

class DomainTestCase extends WebTestCase
{
    protected $fixtures;

    public function loadTestDatabase(): void
    {
        $this->fixtures = $this->loadFixtures(
            array(
                'Authentication\Resources\DataFixtures\RoleFixture',
                'Authentication\Resources\DataFixtures\UserFixtures'
            )
        )->getReferenceRepository();

    }

    public function runAsAdmin(): Client
    {
        $client = self::createClient();
        $user = $this->fixtures->getReference(UserFixtures::ADMIN_USERNAME);
        $client->setServerParameters(array(
            'HTTP_Authorization' => 'Bearer ' . $user->getAccessTokens()->last()->getToken()
        ));
        return $client;
    }

    public function runAsAdminWithBasicAuth(): Client
    {
        $client = self::createClient();
        $client->setServerParameters(array(
            'PHP_AUTH_USER' => UserFixtures::ADMIN_EMAIL,
            'PHP_AUTH_PW' => UserFixtures::ADMIN_PASSWORD
        ));
        return $client;
    }


    public function runAsUser(): Client
    {
        /**
         * @var User $user
         */
        $user = $this->fixtures->getReference(UserFixtures::USER_USERNAME);
        $client = self::createClient();
        $client->setServerParameters(array(
            'HTTP_Authorization' => 'Bearer ' . $user->getAccessTokens()->last()->getToken()
        ));
        return $client;
    }
}
