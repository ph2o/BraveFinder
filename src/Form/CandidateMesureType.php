<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateMesureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rubberBoots')
            ->add('rangerBoots')
            ->add('fireGloves')
            ->add('waitingPants')
            ->add('firePants')
            ->add('sweat')
            ->add('teeshirt')
            ->add('fireJacket');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
            'translation_domain' => 'forms',
        ]);
    }
}
