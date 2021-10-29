<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
            "label" => "First Name",
            ])
            ->add('lastname')
            ->add('slug')
            ->add('description')
            ->add('picture')
            ->add('gender')
            ->add('city')
            ->add('job_status')
            ->add('created_at')
            ->add('updated_at')
            ->add('created_by')
            ->add('updated_by')
            ->add('announcements')
            ->add('social_network')
            ->add('specialization')
            ->add('document')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}