<?php

namespace Authentication\Domain\Entity\Values;

use Authentication\Domain\Entity\User;
use Authentication\Domain\Entity\Client;

class Setting
{
    public const USER_SETTING = 'user';
    public const SYS_SETTING = 'sys';


    private $id;
    /** @var User */
    private $user;
    private $type;
    private $name;
    private $value;
    /** @var Client */
    private $client;

    public function __construct(
        $type,
        $name,
        $value,
        User $user,
        Client $client
    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->user = $user;
        $this->client = $client;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;    
    }
    public function getName()
    {
        return $this->name;
    }
    public function getValue()
    {
        return $this->value;
    }
    public function getClient()
    {
        return $this->client;
    }
}