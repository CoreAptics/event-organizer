<?php

namespace CoreBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PurgeUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('purge:user:expired')
            ->setDescription('Purger la base des utilisateurs inactifs')
            ->setHelp('Permet de passer les utilisateur inactifs en expiré');
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $output->writeln([
            '**** Purge en cours ****'
        ]);
        $listUser = $em->getRepository('CoreBundle:User')->createQueryBuilder('u')
            ->where('u.tokenExpiredAt <= :date')
            ->setParameter('date', new \DateTime())
            ->getQuery()->getResult();

        foreach ($listUser as $user){
            $user->setNonExpired(false);
        }
        $em->flush();

        $output->writeln([
            '**** Exiting ****'
        ]);
    }
}