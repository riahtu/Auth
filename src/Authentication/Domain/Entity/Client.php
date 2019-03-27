<?php

namespace Authentication\Domain\Entity;

use Authentication\Domain\Entity\Values\TokenType;
use Doctrine\Common\Collections\ArrayCollection;

class Client
{
    private $id;

    private $name;
    private $ip;

    private $accessTokens;

    /**
     * Client constructor.
     *
     * @param $name
     * @param $ip
     *
     * @throws \Exception
     */
    public function __construct(
        $name,
        $ip
    )
    {
        $this->name = $name;
        $this->ip = $ip;
        $this->accessTokens = new ArrayCollection();

        $this->addAccessToken(new AccessToken(
            TokenType::BASIC_TOKEN,
            'Auth_app',
            bin2hex(random_bytes(60)),
            true
        ));
    }

    public function addAccessToken(AccessToken $token)
    {
        $token->setClient($this);
        $this->accessTokens[] = $token;
    }

    public function getAccessTokens()
    {
        return $this->accessTokens;
    }

    public function getLastActiveAccessToken()
    {
        foreach ($this->getAccessTokens() as $token){
            if($token->isActive()){
                return $token;
            }
        }
        return false;
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
