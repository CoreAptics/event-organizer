<?php

namespace CoreBundle\Services;


use Doctrine\ORM\EntityManager;

class PurgeUserService
{
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public function purge(){
        $em = $this->manager;
        $listUser = $em->getRepository('CoreBundle:User')->createQueryBuilder('u')
            ->where('u.tokenExpiredAt <= :date')
            ->setParameter('date', new \DateTime())
            ->getQuery()->getResult();

        foreach ($listUser as $user){
            $user->setIsNonExpired(false);
            $em->flush();
        }
    }
}