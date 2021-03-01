<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
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
            ->add('composition')
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
