<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                    'Administrator'  => 'ROLE_ADMIN',
                    'Endurance'      => 'ROLE_ENDURANCE',
                    'Claustrophobie' => 'ROLE_CLOSTROPHOBIE',
                    'Vertige'        => 'ROLE_VERTIGE',
                    'Force physique' => 'ROLE_FORCE',
                    'Confiance'      => 'ROLE_CONFIANCE',
                    'Entretien'      => 'ROLE_ENTRETIEN',
                ],
                'mapped'   => true,
                'label'    => 'Roles',
            ])->add('plainPassword', RepeatedType::class, [
                'label'           => false,
                'type'            => PasswordType::class,
                'first_options'   => [
                    'attr'        => ['autocomplete' => 'new-password'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min'        => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max'        => 4096,
                        ]),
                    ],
                    'label'       => 'New password',
                ],
                'second_options'  => [
                    'attr'  => ['autocomplete' => 'new-password'],
                    'label' => 'Repeat Password',
                ],
                'invalid_message' => 'The password fields must match.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped'          => false,
            ]);

        $builder->get('roles')
            ->addModelTransformer(
                new CallbackTransformer(
                    function ($rolesArray) {
                        return count($rolesArray) ? $rolesArray[0] : null;
                    },
                    function ($rolesString) {
                        return [$rolesString];
                    }
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
