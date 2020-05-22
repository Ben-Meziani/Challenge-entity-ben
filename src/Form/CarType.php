<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Validator\Constraints\Length;
// use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model', null, [
                'constraints' => [
                    new Constraints\NotBlank(),
                    new Constraints\Length([
                        'min' => 2,
                        'max' => 255,
                    ]),
                ]
            ])
            ->add('year', null, [
                'constraints' => [
                    new Constraints\NotBlank(),
                    new Constraints\Range([
                        'min' => 1980,
                        'max' => date('Y') + 1,
                    ]),
                ]
            ])
            ->add('color', null, [
                'constraints' => [
                    new Constraints\NotBlank(),
                    new Constraints\Length([
                        'min' => 2,
                        'max' => 255,
                    ]),
                ]
            ])
            ->add('brand', null,)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
