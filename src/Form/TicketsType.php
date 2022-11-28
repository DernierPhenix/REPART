<?php

namespace App\Form;

use DateTime;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Tickets;
use App\Entity\Categories;
use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TicketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clients', EntityType::class, [
                'class' => Client::class,
                'placeholder' => 'Veuillez selectionner le client',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('etat')
            ->add('statut', ChoiceType::class, [
                'placeholder' => 'Veuillez selectionner le statut',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [

                    'Nouveau' => 'NOUVEAU',
                    'En_cours' => 'EN_COURS',
                    'Resolu' => 'RESOLU',
                    'Clos' => 'CLOS',
                ],
            ])
            ->add('description')

            ->add('createdAt', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'data' => new DateTime(),
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')
            ))
            ->add('updatedAt', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'data' => new DateTime(),
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')
            ))

            ->add('rapport')
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'placeholder' => 'Veuillez selectionner la categorie',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ],
                'mapped' => false
            ])
            ->add('sousCategorie', EntityType::class, [
                'class' => SousCategorie::class,
                'placeholder' => 'Veuillez selectionner la sous-categorie',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ],
                'mapped' => false
            ])
            ->add('produits', EntityType::class, [
                'class' => Produit::class,
                'placeholder' => 'Veuillez selectionner la marque',
                'choice_label' => 'marque',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('modele')
            

            ->add('user', EntityType::class, [
                'class' => User::class,
                'placeholder' => 'Veuillez vous identifier',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ]
            ]);
    }
   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tickets::class,
        ]);
    }
}
