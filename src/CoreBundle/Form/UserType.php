<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array(
            'label'=>'Nom: '
        ))
            ->add('firstname', TextType::class, array(
                'label'=>'Prénom: '
            ))
            ->add('email', EmailType::class, array(
                'label'=>'Email: '
            ))
            ->add('password', RepeatedType::class, array(
                'type'=> PasswordType::class,
                'invalid_message'=>'Les champs doivent être identiques',
                'first_options'=>array('label'=>'Mot de passe'),
                'second_options'=>array('label'=>'Répétez le mot de passe')
            ))
            ->add('S\'inscrire', SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_user';
    }


}
