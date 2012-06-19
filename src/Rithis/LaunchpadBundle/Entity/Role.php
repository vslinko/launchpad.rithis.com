<?php

namespace Rithis\LaunchpadBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;

class Role implements RoleInterface
{
    private $id;
    private $role;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function __toString()
    {
        return $this->role;
    }
}
