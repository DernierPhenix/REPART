<?php

namespace App\Form;

use App\Entity\Update;
use App\Entity\Tickets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UpdateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statut')

            ->add('updatedAt')

            ->add('rapport',TextareaType::class, [
                'label' => 'Rapport de l\'intervention'
            ])
            
            // ->add('ticket', EntityType::class, [
            //     'required' => false,
            //     'class' => Tickets::class
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Update::class,
        ]);
    }
}
