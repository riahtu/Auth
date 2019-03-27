<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 20-Nov-18
 * Time: 20:50
 */

namespace Authentication\Domain\Services\User;


use Authentication\Domain\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use Authentication\Domain\Services\Exceptions\CredentialTakenException;
use Authentication\Infrastructure\Repositories\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Authentication\Domain\Entity\User;

class NewUserRegistration
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * NewUserRegistration constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $em
     */
    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em)
    {
        $this->encoder = $encoder;
        $this->userRepository = $em->getRepository(User::class);
    }

    /**
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @param Role $role
     *
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
//    public function execute($request = null): User
    public function execute(
        string $email,
        string $username,
        string $password,
        Role $role
    ): User
    {
        $this->checkIfCredentialsTaken($email , $username);
        $user = new User(
            $email,
            $role,
            $username
        );
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $this->userRepository->persist($user);

        return $user;
    }

    public function checkIfCredentialsTaken($email , $username): void
    {
        if($this->userRepository->findByEmail($email)){
            throw new CredentialTakenException(['email' => $email]);
        }
        if($this->userRepository->findByUsername($username)){
            throw new CredentialTakenException(['username' => $username]);
        }
    }
}
