<?php


namespace Authentication\Infrastructure\Domain\Consumers;


use Authentication\Application\Service\Role\RemoveRoleRequest;
use Authentication\Application\Service\Role\RemoveRoleService;
use Authentication\Domain\Services\Exceptions\MissingArgumentException;
use Doctrine\ORM\EntityManagerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Transactional\Transactional;

class ProcessRoleRemovedMessage implements ConsumerInterface
{
    use Transactional;
    /**
     * @var RemoveRoleService
     */
    private $removeRoleService;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    private $transaction;

    public function __construct(
        RemoveRoleService $removeRoleService,
        EntityManagerInterface $em
    ) {
        $this->removeRoleService = $removeRoleService;
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
        if(!isset($message['designation'])){
            throw new MissingArgumentException($message);
        }
        $this->transaction->loadService($this->removeRoleService)
                          ->executeTransaction(
                              new RemoveRoleRequest(
                                  $message['designation']
                              )
                          );
        echo 'Role'. $message['designation'] .' removed ';
    }
}
