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
use OldSound\RabbitMqBundle\RabbitMq\Producer;
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
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var Producer
     */
    private $newUserMessageProducer;

    public function __construct(
        NewUserRegistration $newUserRegistrationService,
        EntityManagerInterface $em,
        Producer $newUserMessageProducer
    )
    {
        $this->newUserRegistrationService = $newUserRegistrationService;
        $this->roleRepository = $em->getRepository(Role::class);
        $this->newUserMessageProducer = $newUserMessageProducer;
    }

    /**
     * @param CreateUserRequest $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     */
    public function execute($request = null): array
    {
        $role = $this->roleRepository->findByReference(Role::STARTER_ROLE);

        if(!$role){
            throw new GeneralDomainServerError(['contact' => 'me']);
        }

        $user = $this->newUserRegistrationService->execute(
                $request->getEmail(),
                $request->getUsername(),
                $request->getPassword(),
                $role
        );

        $this->newUserMessageProducer->publish(
            'string testing'
        );

        return array(
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        );
    }
}
