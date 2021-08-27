<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Name',
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Firstname',
                ],
            ])
            ->add('birthdate', DateType::class, [
                'required' => false,
                'widget'   => 'single_text',
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Phone',
                ],
            ])
            ->add('mobile', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Mobile',
                ],
            ])
            ->add('street', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Street',
                ],
            ])
            ->add('houseNumber', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'House number',
                ],
            ])
            ->add('zip', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Zip',
                ],
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'City',
                ],
            ])
            ->add('mail', EmailType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Mail',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => Candidate::class,
            'translation_domain' => 'forms',
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
