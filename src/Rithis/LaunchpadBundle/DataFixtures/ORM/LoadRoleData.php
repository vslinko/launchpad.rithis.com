<?php

namespace Rithis\LaunchpadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rithis\LaunchpadBundle\Entity\Role;

class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $admin = new Role();
        $admin->setRole('ROLE_ADMIN');

        $manager->persist($admin);
        $manager->flush();

        $this->addReference('role-admin', $admin);
    }

    public function getOrder()
    {
        return 1;
    }
}
