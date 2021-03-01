<?php

namespace App\Form;

use App\Entity\Trouver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TrouverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('jour', ChoiceType::class, [
            'label' => 'jour',
            'choices' => [
                'Lundi' => 'Lundi',
                'Mardi' => 'Mardi',
                'Mercredi' => 'Mercredi',
                'Jeudi' => 'Jeudi',
                'Vendredi' => 'Vendredi',
                'Samedi' => 'Samedi',
                'Dimanche' => 'Dimanche',
      ],
            
  ])
            ->add('image', FileType::class, [
                'label' => false,
                'mapped' => false, 
                'required' => true,
                'constraints' => [
                  new File([ 
                    'mimeTypes' => [ 
                      'image/bmp', 
                      'image/gif', 
                      'image/jpeg', 
                      'image/png', 
                      'image/svg+xml',
                      'image/tiff', 
                      'image/webp', 
                    ],
                    'mimeTypesMessage' => "Format non valide.",
                  ])
                ],
            ])
            ->add('ville')
            ->add('adresse')
            ->add('debut', TextType::class , [
                'label' => 'Heure début',
            ])
            ->add('fin', TextType::class , [
                'label' => 'Heure fin',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trouver::class,
        ]);
    }
}
