<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Cosplay;
use CoreBundle\Entity\Event;
use CoreBundle\Entity\Food;
use CoreBundle\Entity\FoodType;
use CoreBundle\Entity\Invitation;
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
        $user->setFirstname('test');
        $user->setEmail('test@test.com');
        $user->setPassword('test');
        $user->setUid();
        $manager->persist($user);

        $foodType = new FoodType();
        $foodType->setName('Boissons');
        $manager->persist($foodType);

        $foodType = new FoodType();
        $foodType->setName('Nourriture');
        $manager->persist($foodType);

        $event = new Event();
        $event->setEventOwner($user);
        $event->setName('Anniversaire');
        $event->setDate(new \DateTime());
        $event->setDescription('Test');
        $manager->persist($event);

        $cosplay = new Cosplay();
        $cosplay->setName('Morphsuit');
        $manager->persist($cosplay);

        $food = new Food();
        $food->setName('Chips');
        $food->setNb(2);
        $food->setType($foodType);
        $manager->persist($food);

        $invitation = new Invitation();
        $invitation->setCosplay($cosplay);
        $invitation->addFood($food);
        $invitation->setUser($user);
        $invitation->setStatus(0);
        $invitation->setEvent($event);
        $manager->persist($invitation);

        $manager->flush();
    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}