<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('marque', EntityType::class, [
            'class' => Marque::class,
            'placeholder' => 'Veuillez selectionner la marque',
            'label' => 'Marque',
            
            'choice_label' => 'nom',
            'attr' => [
                'class' => 'select2'
            ],
           
        ])
            ->add('modele')
            ->add('sousCategories', EntityType::class, [
                'class' => SousCategorie::class,
                'choice_label' => 'nom',
                
            ]);
        ;
    }
            

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
