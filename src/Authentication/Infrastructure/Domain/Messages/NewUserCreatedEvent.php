<?php


namespace Authentication\Infrastructure\Domain\Messages;


use Authentication\Domain\Entity\User\User;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

class NewUserCreatedEvent extends Producer
{

    /**
     * @param User $user
     */
    public function publishMessage(User $user): void
    {
        $msg = [
            'username'=> $user->getUsername(),
            'email' => $user->getEmail()
        ];

        $this->publish(json_encode($msg));
    }
}
