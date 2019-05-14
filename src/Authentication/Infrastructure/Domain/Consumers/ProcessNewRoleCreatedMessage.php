<?php


namespace Authentication\Infrastructure\Domain\Consumers;


use Authentication\Application\Service\Role\CreateNewRoleRequest;
use Authentication\Application\Service\Role\CreateNewRoleService;
use Authentication\Domain\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Transactional\Transactional;

class ProcessNewRoleCreatedMessage implements ConsumerInterface
{
    use Transactional;
    /**
     * @var CreateNewRoleService
     */
    private $createRoleService;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    private $transaction;

    public function __construct(
        CreateNewRoleService $createRoleService,
        EntityManagerInterface $em
    ) {
        $this->createRoleService = $createRoleService;
        $this->transaction       = $this->createTransaction($em);
    }

    /**
     * @param AMQPMessage $msg The message
     *
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        $message = json_decode($msg->getBody(), true);

        $role = new Role(
            $message['name'],
            $message['designation']
        );
        $this->transaction->loadService($this->createRoleService)
                          ->executeTransaction(new CreateNewRoleRequest(
                                  $message['name'],
                                  $message['designation']
                              )
                          );
        echo 'New role added ' . $role->getName();
    }
}
