<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Parameter;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadParemeterData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $csv = fopen(dirname(__FILE__) . '/parameter.csv', 'r');

        while (!feof($csv)) {
            $line = fgetcsv($csv, 0, ';');

            if ($line == null) {
                break;
            }

            $parameter = new Parameter();
            $parameter->setName($line[0]);
            $parameter->setValue($line[1]);

            $manager->persist($parameter);
            $manager->flush();
        }
    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}