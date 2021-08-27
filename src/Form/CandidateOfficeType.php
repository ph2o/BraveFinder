<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CandidateOfficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pictureFile', VichImageType::class, [
                'required'        => false,
                'download_uri'    => false,
                'allow_delete'    => false,
                'imagine_pattern' => 'image_thumb',
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Name',
                ],
            ])
            ->add('firstname', TextType::class, [
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Firstname',
                ],
            ])
            ->add('birthdate', DateType::class, [
                'required' => true,
                'widget'   => 'single_text',
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'help' => 'Phone',
                'attr' => [
                    'placeholder' => 'Phone',
                ],
            ])
            ->add('mobile', TextType::class, [
                'help' => 'Mobile',
                'attr' => [
                    'placeholder' => 'Mobile',
                ],
            ])
            ->add('street', TextType::class, [
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Street',
                ],
            ])
            ->add('houseNumber', TextType::class, [
                'attr' => [
                    'placeholder' => 'House number',
                ],
            ])
            ->add('zip', TextType::class, [
                'required' => true,
                'attr'     => [
                    'placeholder' => 'ZIP',
                ],
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'attr'     => [
                    'placeholder' => 'City',
                ],
            ])
            ->add('mail', TextType::class, [
                'required' => true,
                'attr'     => [
                    'placeholder' => 'Mail',
                ],
            ])
            ->add('SocialNumber', TextType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Social number',
                ],
            ])
            ->add('Iban', TextType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Iban',
                ],
            ])
            ->add('BankName', TextType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Bank name',
                ],
            ])
            ->add('originName', TextType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Origin name',
                ],
            ])
            ->add('PathWay', null, ['placeholder' => 'Select...',])
            ->add('Education')
            ->add('Title', null, [
                'placeholder' => 'Choose Title',
                'required'    => true,
            ])
            ->add('MaritalStatus', null, [
                'placeholder' => 'Choose Status',
                'required'    => true,
            ])
            ->add('Station', null, ['placeholder' => 'Select...',]);
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
