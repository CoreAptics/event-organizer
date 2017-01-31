<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('Test');
        $admin->setFirstname('Test');
        $admin->setIsActive(1);
        $admin->setUid('UID1');
        $plainPass = 'test';
        $encoder = $this->container->get('security.password_encoder');
        $encodedPass = $encoder->encodePassword($admin, $plainPass);
        $admin->setPassword($encodedPass);
        $admin->setEmail('test@test.com');

        $manager->persist($admin);
        $manager->flush();
    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}