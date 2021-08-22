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
            ->add('waitingPants', null, ['required' => true, 'placeholder' => 'Select...'])
            ->add('firePants', null, ['required' => true, 'placeholder' => 'Select...'])
            ->add('sweat', null, ['required' => true, 'placeholder' => 'Select...'])
            ->add('teeshirt', null, ['required' => true, 'placeholder' => 'Select...'])
            ->add('fireJacket', null, ['required' => true, 'placeholder' => 'Select...'])
            ->add('HeadCircumference', null, ['required' => true, 'placeholder' => 'Select...']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
            'translation_domain' => 'forms',
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
