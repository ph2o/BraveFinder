<?php

namespace App\Form;

use App\Entity\Evaluation;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'rate',
                null,
                ['attr' => [
                    'class' => 'rating',
                    'step' => '1'
                ]]
            )
            ->add('comment', null, ['attr' => ['rows' => 10]])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $evaluation = $event->getData();
                $form = $event->getForm();
                if (is_object($evaluation->getPractice()) and $evaluation->getPractice()->getInterview()) {
                    $form
                        ->add('interviewer_1')
                        ->add('interviewer_2');
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
            'translation_domain' => 'forms',
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
