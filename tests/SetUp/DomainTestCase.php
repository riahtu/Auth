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
use Authentication\Resources\DataFixtures\UserFixture;
use Symfony\Bundle\FrameworkBundle\Client;

class DomainTestCase extends WebTestCase
{
    protected $fixtures;

    public function loadTestDatabase(): void
    {
        $this->fixtures = $this->loadFixtures(
            array(
                'Authentication\Resources\DataFixtures\RoleFixture',
                'Authentication\Resources\DataFixtures\UserFixture',
                'Authentication\Resources\DataFixtures\ClientFixture',
                'Authentication\Resources\DataFixtures\PermissionFixture'
            )
        )->getReferenceRepository();

    }

    public function runAsAdmin(): Client
    {
        $client = self::createClient();
        $user = $this->fixtures->getReference(UserFixture::ADMIN_USERNAME);
        $client->setServerParameters(array(
            'HTTP_Authorization' => 'Bearer ' . $user->getAccessTokens()->last()->getToken()
        ));
        return $client;
    }

    public function runAsAdminWithBasicAuth(): Client
    {
        $client = self::createClient();
        $client->setServerParameters(array(
            'PHP_AUTH_USER' => UserFixture::ADMIN_USERNAME,
            'PHP_AUTH_PW' => UserFixture::ADMIN_PASSWORD
        ));
        return $client;
    }


    public function runAsUser(): Client
    {
        /**
         * @var User $user
         */
        $user = $this->fixtures->getReference(UserFixture::USER_USERNAME);
        $client = self::createClient();
        $client->setServerParameters(array(
            'HTTP_Authorization' => 'Bearer ' . $user->getAccessTokens()->last()->getToken()
        ));
        return $client;
    }

    public function runAsUserWithBasicAuth(): Client
    {
        $client = self::createClient();
        $client->setServerParameters(array(
            'PHP_AUTH_USER' => UserFixture::USER_USERNAME,
            'PHP_AUTH_PW' => UserFixture::USER_PASSWORD
        ));
        return $client;
    }
}
