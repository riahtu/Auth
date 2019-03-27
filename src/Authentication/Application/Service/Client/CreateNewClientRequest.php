<?php

namespace Authentication\Application\Service\Client;

class CreateNewClientRequest
{
    private $name;
    private $ip;
    public function __construct(
        $name,
        $ip
    )
    {
        $this->name;
        $this->ip;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIp()
    {
        return $this->ip;
    }
}