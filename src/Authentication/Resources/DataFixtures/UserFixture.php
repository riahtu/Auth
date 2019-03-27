<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 11-Feb-19
 * Time: 21:18
 */

namespace Authentication\Resources\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Authentication\Domain\Entity\AccessToken;
use Authentication\Domain\Entity\Role;
use Authentication\Domain\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    const ADMIN_EMAIL = 'admin@admin.com';
    const ADMIN_USERNAME = 'Admin';
    const ADMIN_PASSWORD = 'Admin';
    const USER_EMAIL = 'user@user.com';
    const USER_USERNAME = 'User';
    const USER_PASSWORD = 'User';
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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
        $adminRole = $roleRepository->findByReference(Role::ADMIN_ROLE);
        $userRole = $roleRepository->findByReference(Role::STARTER_ROLE);
        $admin = new User(
            self::ADMIN_EMAIL,
            $adminRole,
            self::ADMIN_USERNAME
        );
        $admin->addRole($userRole);
        $admin->addAccessToken(new AccessToken(
            'basic',
            'test'
        ));
        $admin->setPassword($this->encoder->encodePassword($admin,self::ADMIN_PASSWORD));
        $this->setReference($admin->getUsername(), $admin);
        $manager->persist($admin);
        $user = new User(
            self::USER_EMAIL,
            $userRole,
            self::USER_USERNAME
        );
        $user->addAccessToken(new AccessToken(
            'basic',
            'test'
        ));
        $user->setPassword($this->encoder->encodePassword($user,self::USER_PASSWORD));
        $manager->persist($user);
        $this->setReference($user->getUsername(), $user);
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
