<?php

namespace App\Form;

use App\Entity\Evaluation;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('validate', CheckboxType::class, [
                'required'   => false,
                'label'      => false,
                'help'       => 'Mark this evaluation as closed',
                'label_attr' => ['class' => 'form-check-label'],
            ])
            ->add('comment', null, ['attr' => ['rows' => 10]])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $evaluation = $event->getData();
                $form       = $event->getForm();
                if (is_object($evaluation->getPractice()) and $evaluation->getPractice()->getInterview()) {
                    $form
                        ->add('interviewer_1', null, ['required' => true, 'placeholder' => 'Choose an option'])
                        ->add('interviewer_2', null, ['required' => true, 'placeholder' => 'Choose an option']);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => Evaluation::class,
            'translation_domain' => 'forms',
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
