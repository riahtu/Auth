<?php

namespace Authentication\Domain\Entity;

class Client
{
    private $id;

    private $name;
    private $ip;

    /**
     * Client constructor.
     *
     * @param $name
     * @param $ip
     */
    public function __construct(
        $name,
        $ip
    )
    {
        $this->name = $name;
        $this->ip = $ip;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

}
