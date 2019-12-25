<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CandidateOfficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('firstname')
            ->add('birthdate', DateType::class, [
                'required'   => false,
                'widget' => 'single_text',
            ])
            ->add('phone')
            ->add('mobile')
            ->add('street')
            ->add('houseNumber')
            ->add('zip')
            ->add('city')
            ->add('mail')
            ->add('mailPro');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
            'translation_domain' => 'forms',
        ]);
    }
}
