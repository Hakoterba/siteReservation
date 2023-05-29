<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    
        $builder
        ->add('dateDepart', DateType::class, [
            'widget' => 'single_text',
        ])
        ->add('dateRetour', DateType::class, [
            'widget' => 'single_text',
        ])
        ->add('nombrePlace', IntegerType::class, [
            'attr' => ['min' => 1],
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}