<?php

namespace FrontBundle\Controller;

use CoreBundle\Entity\User;
use CoreBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends Controller
{
    public function loginAction(){
        $authenticationUtils = $this->get('security.authentication_utils');
        
        return $this->render('@Front/User/login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $userToCompare = $em->getRepository('CoreBundle:User')->findOneBy(array(
                'email'=>$user->getEmail()
            ));

            if($userToCompare == null){

//                Initialisation des variables
                $tokenExpiration = $em->getRepository('CoreBundle:Parameter')->findOneBy(array(
                    'name'=>'tokenExpiration'
                ));
                $dateInSevenDays = new \DateTime();
                $dateInSevenDays->add(new \DateInterval('P'.$tokenExpiration->getValue().'D'));
                $plainPassword = $user->getPassword();

//                Encodage du MDP
                $encoder = $this->get('security.password_encoder');
                $encodedPassword = $encoder->encodePassword($user,$plainPassword);
                $user->setPassword($encodedPassword);

//                Définition du Token d'activation
                $user->setToken(hash('sha256', $user->getEmail()));
                $user->setTokenExpiredAt($dateInSevenDays);

//                Désactivation du compte
                $user->setIsActive(FALSE);

//                Persistance de l'entité
                $em->persist($user);
                $em->flush();

//                Création d'une instance de message
                $message = \Swift_Message::newInstance()
                    ->setSubject('Activation de votre compte')
                    ->setFrom('alexei.taupiot@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody($this->renderView(
                        'Emails/activation.html.twig',
                        array(
                            'token'=>$this->generateUrl('front_user_activate', array(
                                'token'=>$user->getToken()
                            ), UrlGeneratorInterface::ABSOLUTE_URL),
                            'date'=>$dateInSevenDays
                        )
                    ),
                        'text/html'
                    );

                $this->get('mailer')->send($message);

                return $this->redirectToRoute('front_homepage');
            } else {
                return $this->render('@Front/User/register.html.twig', array(
                    'message'=> 'Email déjà prit',
                    'form'=>$form->createView()
                ));
            }
        }

        return $this->render('@Front/User/register.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    public function activateAction(Request $request, $token){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CoreBundle:User')->findOneBy(array(
            'token'=>$token
        ));
        if ($user == null){
            return $this->render('@Front/User/info.html.twig', array('message'=>'Compte inexistant ou déjà activé.'));
        }
        dump($user->isEnabled());
        dump($user->isAccountNonExpired());
        if ($user->isEnabled() == false and $user->isAccountNonExpired() == true){
            $user->setTokenExpiredAt(null);
            $user->setToken(null);
            $user->setIsActive(true);
            $em->flush();
            return $this->render('@Front/User/info.html.twig', array('message'=>'Votre compte a été activé avec succès.'));


        } elseif ($user->isEnabled() == false and $user->isAccountNonExpired() == false){
            return $this->render('@Front/User/info.html.twig', array('message'=>'Votre compte est bloqué et désactivé suite à une trop grande inactivité, contactez-nous pour plus d\'informations.'));


        } elseif ($user->isEnabled() and $user->isAccountNonExpired() == false){
            return $this->render('@Front/User/info.html.twig', array('message'=>'Votre compte est activé mais bloqué suite à une trop grande inactivité, contactez-nous pour plus d\'informations.'));


        } else {
            return $this->render('@Front/User/info.html.twig', array('message'=>'Erreur inconnue.'));
        }
    }
}
