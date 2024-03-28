<?php

namespace App\Form;

use App\Entity\JobCategory;
use App\Entity\Jobs;
use App\Entity\JobType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('description')
            ->add('activity')
            ->add('notes')
            ->add('jobTitle')
            ->add('location')
            // ->add('dateClosing', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('salary')
            // ->add('dateCreated', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('jobType', EntityType::class, [
                'class' => JobType::class,
                'choice_label' => 'id',
            ])
            ->add('jobCategory', EntityType::class, [
                'class' => JobCategory::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jobs::class,
        ]);
    }
}
