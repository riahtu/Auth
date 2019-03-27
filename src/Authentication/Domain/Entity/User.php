<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Dec-18
 * Time: 19:20
 */

namespace Authentication\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, UserValidationInterface
{
    private $id;
    /**
     * @var null
     */
    private $username;
    private $email;
    private $password;
    /**
     * @var PersistentCollection
     */
    private $roles;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var PersistentCollection
     */
    private $accessTokens;
    /**
     * @var PersistentCollection
     */
    private $settings;


    /**
     * User constructor.
     *
     * @param $email
     * @param Role $role
     * @param null $username
     * @throws \Exception
     */
    public function __construct(
        $email,
        Role $role,
        $username = null
    )
    {
        $this->username = $username;
        $this->email = $email;
        $this->createdAt = new \DateTime();
        $this->accessTokens = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->settings = new ArrayCollection();

        $this->addRole($role);
    }

    /**
     * @return null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roleArray = array();
        /**
         * @var Role $role
         */
        foreach ($this->roles as $role){
            $roleArray[] = $role->getRole();
        }
        return array_unique($roleArray);
    }

    /**
     * @param null $username
     *
     * @return User
     */
    public function setUsername($username): User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param mixed $password
     *
     * @return User
     */
    public function setPassword($password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function addRole(Role $role): User
    {
        $role->addUser($this);
        $this->roles[] = $role;
        return $this;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function removeRole(Role $role): User
    {
        $role->removeUser($this);
        $this->roles->removeElement($role);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return PersistentCollection
     */
    public function getAccessTokens(): PersistentCollection
    {
        return $this->accessTokens;
    }

    public function addAccessToken(AccessToken $accessToken): User
    {
        $accessToken->setUser($this);
        $this->accessTokens[] = $accessToken;

        return $this;
    }

    /**
     * @param string $route
     * @return bool|Permission
     */
    public function hasPermission(string $route)
    {
        /**@var Role $role */
        foreach ($this->roles as $role){
            $check = $role->hasPermission($route);
            if($check){
                return $check;
            }
        }
        return false;
    }

    public function getSettings()
    {
        return $this->settings;
    }

}
