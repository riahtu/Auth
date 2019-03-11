<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 12-Jan-19
 * Time: 10:08
 */

namespace Authentication\Application\Service\User;


use Authentication\Domain\Services\Exceptions\GeneralDomainServerError;
use Authentication\Domain\Services\User\NewUserRegistration;
use Doctrine\ORM\EntityManagerInterface;
use Authentication\Domain\Entity\Role;
use Transactional\Interfaces\TransactionalServiceInterface;

class CreateUserService implements TransactionalServiceInterface
{

    /**
     * @var NewUserRegistration
     */
    private $newUserRegistrationService;
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Authentication\Infrastructure\Repositories\RoleRepository
     */
    private $roleRepository;

    public function __construct(
        NewUserRegistration $newUserRegistrationService,
        EntityManagerInterface $em
    )
    {
        $this->newUserRegistrationService = $newUserRegistrationService;
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param CreateUserRequest $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     */
    public function execute($request = null): array
    {
        if ($request->getRole()) {
            $role = $this->roleRepository->findByReference($request->getRole());
        } else {
            $role = $this->roleRepository->findByReference(Role::STARTER_ROLE);
        }
        if(!$role){
            throw new GeneralDomainServerError(['contact' => 'me']);
        }

        $user = $this->newUserRegistrationService->execute(
                $request->getEmail(),
                $request->getUsername(),
                $request->getPassword(),
                $role
        );

        return array(
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        );
    }
}
