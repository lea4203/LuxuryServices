<?php

namespace App\Form;

use App\Entity\Candidats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CandidatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('adress')
            ->add('country')
            ->add('nationality')
            // ->add('passportFile', FileType::class, [
            //     'label' => false,
            //     'mapped' => false,
            //     'constraints' => [
            //         new File([
            //             'maxSize' => '1024k',
            //             'mimeTypes' => [
            //                 'image/jpeg',
            //                 'image/png',
            //                 'image/gif',
            //             ],
            //             'mimeTypesMessage' => 'Please upload a valid image document',
            //         ]),
            //     ],
            // ])
            // ->add('profilPicture', FileType::class, [
            //     'label' => false,
            //     'mapped' => false,
            //     'constraints' => [
            //         new File([
            //             'maxSize' => '1024k',
            //             'mimeTypes' => [
            //                 'image/*',
            //             ],
            //             'mimeTypesMessage' => 'Please upload a valid document',
            //         ])
            //     ]
            // ])
            // ->add('cv', FileType::class, [
            //     'label' => false,
            //     'mapped' => false,
            //     'constraints' => [
            //         new File([
            //             'maxSize' => '1024k',
            //             'mimeTypes' => [
            //                 'image/',
            //             ],
            //             'mimeTypesMessage' => 'Please upload a valid document',
            //         ])
            //     ]
            // ])
            ->add('location')
            ->add('dateBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('placeBirth')
            ->add('shortDescription');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidats::class,
        ]);
    }
}
