<?php

namespace Rithis\LaunchpadBundle\Entity;

use DateTime;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Account implements AdvancedUserInterface
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $salt;
    private $roles;
    private $accountExpirationDate;
    private $accountNonLocked = true;
    private $credentialsExpirationDate;
    private $enabled = true;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function addRole(Role $role)
    {
        $this->roles[] = $role;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setAccountExpirationDate(DateTime $accountExpirationDate = null)
    {
        $this->accountExpirationDate = $accountExpirationDate;
    }

    public function getAccountExpirationDate()
    {
        return $this->accountExpirationDate;
    }

    public function isAccountNonExpired()
    {
        return !$this->accountExpirationDate instanceof DateTime || $this->accountExpirationDate > new DateTime();
    }

    public function setAccountNonLocked($accountNonLocked)
    {
        $this->accountNonLocked = $accountNonLocked;
    }

    public function isAccountNonLocked()
    {
        return $this->accountNonLocked;
    }

    public function setCredentialsExpirationDate(DateTime $credentialsExpirationDate = null)
    {
        $this->credentialsExpirationDate = $credentialsExpirationDate;
    }

    public function getCredentialsExpirationDate()
    {
        return $this->credentialsExpirationDate;
    }

    public function isCredentialsNonExpired()
    {
        return !$this->credentialsExpirationDate instanceof DateTime || $this->credentialsExpirationDate > new DateTime();
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function eraseCredentials()
    {
    }

    public static function generateSalt()
    {
        return hash('sha512', microtime(true));
    }
}
