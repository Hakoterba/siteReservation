<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre nom.']),
                    new Length(['max' => 30, 'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.']),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre prénom.']),
                    new Length(['max' => 30, 'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères.']),
                ],
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre adresse email.']),
                    new Length(['max' => 30, 'maxMessage' => 'L\'email ne peut pas dépasser {{ limit }} caractères.']),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe'
                ],
                'second_options' => [
                    'label' => 'Confirmez le mot de passe',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre mot de passe.']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                        'normalizer' => 'trim',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/',
                        'message' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et doit avoir une longueur minimale de 8 caractères.',
                    ]),
                ],
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Numéro de téléphone',
                'required' => false,
                'constraints' => [
                    new Length(['max' => 10, 'maxMessage' => 'Le numéro de téléphone ne peut pas dépasser {{ limit }} caractères.']),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'btn btn-primary btn-block',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
