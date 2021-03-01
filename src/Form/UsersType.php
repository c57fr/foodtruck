<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('prenom', TextType::class,[
            'label' => 'Prénom',
            'constraints'=> [
                 new NotBlank(['message' => 'Merci de saisir votre Prénom'])
            ],
            'required' => true,          
                        ])
        ->add('nom', TextType::class,[
            'constraints'=> [
            new NotBlank(['message' => 'Merci de saisir votre nom'])
                            ],
                            'required' => true,          
                                        ])                
            ->add('email', EmailType::class,[
                'constraints'=> [
                     new NotBlank(['message' => 'Merci de saisir une adresse email'])
                ],
                'required' => true,          
                            ])
           // ->add('roles')
           ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les deux mots de passe doivent être identiques.',
            'required' => false,
            'help' => 'Pour modifier le mot de passe, entrez-le nouveau mot de passe deux fois',
            'first_options'  => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Répétez le mot de passe'],
            'mapped' => false,
        ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
