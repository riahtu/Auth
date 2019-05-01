<?php


namespace Authentication\Infrastructure\Domain\Messages;


use Authentication\Domain\Entity\User\User;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

class NewUserCreatedEvent extends Producer
{

    public function publishMessage(User $user)
    {
        $msg = [
            'username'=> $user->getUsername(),
            'email' => $user->getEmail()
        ];

        $this->publish(json_encode($msg));
    }
}
