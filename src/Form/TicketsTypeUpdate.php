<?php

namespace App\Form;


use App\Entity\Client;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\Tickets;
use App\Entity\Categories;
use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class TicketsTypeUpdate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clients', EntityType::class, [
                'class' => Client::class,
                'label' => 'Client',

                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ]
            ])

            ->add('statut', ChoiceType::class, [
                'placeholder' => 'Veuillez selectionner le statut',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [


                    'EN COURS' => 'EN COURS',
                    'RESOLU' => 'RESOLU',
                    'CLOS' => 'CLOS',
                ],
            ])


            ->add('produits', EntityType::class, [
                'class' => Produit::class,
                'placeholder' => 'Veuillez selectionner le modele',
                'label' => 'Modele',
                'choice_label' => 'modele',
                'attr' => [
                    'class' => 'select2'
                ],

            ])
            ->add('etat', TextareaType::class, [
                'label' => 'Etat du produit'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la panne'
            ])
            ->add('rapport', TextareaType::class, [
                'label' => 'Rapport de l\'intervention'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tickets::class,
        ]);
    }
}
