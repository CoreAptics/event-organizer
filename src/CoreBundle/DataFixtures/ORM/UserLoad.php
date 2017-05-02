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
        $user = new User();
        $user->setUsername('Test');
        $user->setFirstname('Test');
        $user->setActive(1);
        $user->setUid('UID1');
        $plainPass = 'test';
        $encoder = $this->container->get('security.password_encoder');
        $encodedPass = $encoder->encodePassword($user, $plainPass);
        $user->setPassword($encodedPass);
        $user->setEmail('test@test.com');

        $manager->persist($user);
        $manager->flush();
    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}