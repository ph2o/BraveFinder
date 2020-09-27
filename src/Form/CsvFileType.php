<?php

namespace App\Form;

use App\Entity\CsvFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CsvFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brochure', FileType::class, [
                'label' => 'Fichier de base (CSV)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'text/csv',
                        ],
                        'mimeTypesMessage' => 'Charger un fichier csv',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CsvFile::class,
        ]);
    }
}
