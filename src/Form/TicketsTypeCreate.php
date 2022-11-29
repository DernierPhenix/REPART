<?php

namespace App\Form;



use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Tickets;
use App\Entity\Categories;
use App\Entity\SousCategorie;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class TicketsTypeCreate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clients', EntityType::class, [
                'class' => Client::class,
                'label' => 'Client',
                'placeholder' => 'Veuillez sélectionner le client',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'label' => 'Catégorie',
                'placeholder' => 'Veuillez sélectionner la catégorie',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ],
                'mapped' => false
            ])
            
            ->add('sousCategorie', EntityType::class, [
                'class' => SousCategorie::class,
                'label' => 'Sous-Catégorie',
                'placeholder' => 'Veuillez sélectionner la sous-catégorie',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ],
                'mapped' => false
            ])

            ->add('produits', EntityType::class, [
                'class' => Produit::class,
                'label' => 'Marque',
                'placeholder' => 'Veuillez sélectionner la marque',
                'choice_label' => 'marque',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            
            ->add('modele',TextareaType::class,[
                'label' => 'Modèle'
            ])
            
            ->add('etat',TextareaType::class,[
                'label' => 'État du Produit'
            ])
            ->add('description',TextareaType::class,[
                'label' => 'Description de la Panne'
            ]);
            
        
    }
   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tickets::class,
        ]);
    }
}