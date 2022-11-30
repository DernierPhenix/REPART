<?php

namespace App\Form;



use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Tickets;
use App\Entity\Categories;
use App\Entity\Marque;
use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TicketsTypeCreate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clients', EntityType::class, [
                'class' => Client::class,
                'label' => 'Client',
                'placeholder' => 'Veuillez selectionner le client',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            
           
            

            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'placeholder' => 'Veuillez selectionner la categorie',
                'choice_label' => 'nom',
                'label' => 'Categorie',
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
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'placeholder' => 'Veuillez selectionner la marque',
                'label' => 'Marque',
                'mapped' => false,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'select2'
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
            ->add('etat',TextareaType::class,[
                'label' => 'Etat du produit'
            ])
            ->add('description',TextareaType::class,[
                'label' => 'Description de la panne'
            ]);
            
        
    }
   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tickets::class,
        ]);
    }
}
