<?php

namespace Authentication\Domain\Entity\Client;

use Authentication\Domain\Entity\Values\TokenType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

class Client implements UserInterface
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
            TokenType::BASIC_TOKEN
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

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
