<?php

namespace App\Form;

use App\Entity\Candidats;
use App\Entity\Candidature;
use App\Entity\Jobs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('submitAt', null, [
                'widget' => 'single_text',
            ])
            ->add('status')
            ->add('candidat', EntityType::class, [
                'class' => Candidats::class,
                'choice_label' => 'id',
            ])
            ->add('jobs', EntityType::class, [
                'class' => Jobs::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidature::class,
        ]);
    }
}
