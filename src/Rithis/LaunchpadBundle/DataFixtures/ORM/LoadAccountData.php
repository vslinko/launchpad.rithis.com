<?php

namespace Rithis\LaunchpadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Rithis\LaunchpadBundle\Entity\Account;

class LoadAccountData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $ceo = new Account();
        $ceo->setUsername('ceo');
        $ceo->setEmail('ceo@rithis.com');
        $ceo->addRole($this->getReference('role-admin'));
        $ceo->setPassword('12345Wq');

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($ceo);
        $ceo->encodePassword($encoder);

        $manager->persist($ceo);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
