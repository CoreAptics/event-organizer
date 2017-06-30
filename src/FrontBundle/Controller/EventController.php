<?php

namespace FrontBundle\Controller;

use CoreBundle\Entity\Event;
use CoreBundle\Entity\Food;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listEvents = $em->getRepository('CoreBundle:Event')->findAll();

        $json = array();
        $json['success'] = true;
        $json['data'] = array();
        foreach ($listEvents as $event){
            $json['data'][] = array(
                'id'=>$event->getId(),
                'name'=> $event->getName(),
                'description' => $event->getDescription(),
                'date'=>$event->getDate(),
                'nbUsers'=> $event->getNbUsers(),
                'latitude'=> $event->getLatitude(),
                'longitude'=>$event->getLongitude(),
                'phone'=> $event->getPhone(),
                'eventOwner' => array(
                    'email'=>$event->getEventOwner()->getEmail(),
                    'name'=>$event->getEventOwner()->getUsername(),
                    'firstName'=>$event->getEventOwner()->getFirstname(),
                    'uid'=>$event->getEventOwner()->getUid()
                )
            );
        }

        return new JsonResponse($json);
    }
    public function viewAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if(!$request->get('id')){
            $json = array();
            $json['success'] = false;
            $json['response']= 'Event view failed';

            return new JsonResponse($json);
        }

        $event = $em->getRepository('CoreBundle:Event')->find($request->get('id'));
        $json = array();
        $json['success'] = true;
        $json['data'] = array(
            'id'=>$event->getId(),
            'name'=> $event->getName(),
            'description' => $event->getDescription(),
            'date'=>$event->getDate(),
            'nbUsers'=> $event->getNbUsers(),
            'latitude'=> $event->getLatitude(),
            'longitude'=>$event->getLongitude(),
            'phone'=> $event->getPhone(),
            'eventOwner' => array(
                'email'=>$event->getEventOwner()->getEmail(),
                'name'=>$event->getEventOwner()->getUsername(),
                'firstName'=>$event->getEventOwner()->getFirstname(),
                'uid'=>$event->getEventOwner()->getUid()
            )
        );

        return new JsonResponse($json);
    }
    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if(!$request->get('name') || !$request->get('description') || !$em->getRepository('CoreBundle:User')->findOneBy(array('uid'=>$request->get('uid')))){
            $json = array();
            $json['success'] = false;
            $json['response']= 'Event registration failed';

            return new JsonResponse($json);
        }

        $event = new Event();
        $event->setName($request->get('name'));
        $event->setDescription($request->get('description'));
        $event->setEventOwner($em->getRepository('CoreBundle:User')->findOneBy(array('uid'=>$request->get('uid'))));
        $date = \DateTime::createFromFormat('d/m/Y', $request->get('date'));
        $event->setDate($date);
        if($request->get('nbUsers')){
            $event->setNbUsers($request->get('nbUsers'));
        }
        if($request->get('phone')){
            $event->setPhone($request->get('phone'));
        }
        if($request->get('latitude')){
            $event->setLatitude($request->get('latitude'));
        }
        if($request->get('longitude')){
            $event->setLongitude($request->get('longitude'));
        }
        $em->persist($event);
        $em->flush();

        $json = array();
        $json['success'] = true;
        $json['response']= 'Event registration done';

        return new JsonResponse($json);
    }

    public function editAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('CoreBundle:Event')->find($request->get('id'));
        if(!$event || $request->get('uid') != $event->getEventOwner()->getUid()){
            $json = array();
            $json['success'] = false;
            $json['response']= 'Event edition failed';

            return new JsonResponse($json);
        }

        if($request->get('name')){
            $event->setName($request->get('name'));
        }
        if($request->get('description')){
            $event->setDescription($request->get('description'));
        }
        if($request->get('date')){
            $date = \DateTime::createFromFormat('d/m/Y', $request->get('date'));
            $event->setDate($date);
        }
        if($request->get('nbUsers')){
            $event->setNbUsers($request->get('nbUsers'));
        }
        if($request->get('phone')){
            $event->setPhone($request->get('phone'));
        }
        if($request->get('latitude')){
            $event->setLatitude($request->get('latitude'));
        }
        if($request->get('longitude')){
            $event->setLongitude($request->get('longitude'));
        }

        $em->flush();

        $json = array();
        $json['success'] = true;
        $json['response']= 'Event edition done';

        return new JsonResponse($json);
    }

    public function getAllInvitationsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if(!$em->getRepository('CoreBundle:User')->findOneBy(array('uid'=>$request->get('uid')))){
            $json = array();
            $json['success'] = false;
            $json['response']= 'Invitations retrieving failed';

            return new JsonResponse($json);
        }

        $listInvitations = $em->getRepository('CoreBundle:Invitation')->findBy(array(
            'event'=>$em->getRepository('CoreBundle:Event')->findOneBy(array(
                'id'=>$request->get('id'),
                'eventOwner'=>$em->getRepository('CoreBundle:User')->findOneBy(array('uid'=>$request->get('uid')))
            ))
        ));

        $json = array();
        $json['success'] = true;
        $json['data'] = array();

        foreach ($listInvitations as $invitation){
            $foodArray =array();
            foreach ($invitation->getFoods() as $food){
                /**
                 * @var $food Food
                 */
                $foodArray[] = array(
                    'name'=>$food->getName(),
                    'quantity'=>$food->getNb(),
                    'type'=>$food->getType()->getName()
                );
            }
            $json['data'][]= array(
                'user'=> array(
                    'name' => $invitation->getUser()->getUsername(),
                    'firstName' => $invitation->getUser()->getFirstname()
                ),
                'cosplay' => array(
                    'name'=> $invitation->getCosplay()->getName()
                ),
                'food' => $foodArray
            );
        }

        return new JsonResponse($json);
    }



}
