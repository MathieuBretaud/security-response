<?php

namespace App\Form\BackOffice;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci de saisir une adresse email"
                    ])
                ],
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]

            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Membre' => 'ROLE_MEMBER',
                    'Entreprise' => 'ROLE_ENTREPRISE',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles'
            ])
            ->add('password')
            ->add('isVerified')

            // ->add('userMember', MemberType::class, [
            //     'label' => false,
            //     'required' => false,
            // ])

            // ->add('userEnterprise', EnterpriseType::class, [
            //     'label' => false,
            //     'required' => false,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    public function getDefaultOptions()
    {
        return array(
            'roles' => null
        );
    }
}
