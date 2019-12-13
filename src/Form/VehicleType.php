<?php

namespace App\Form;

use App\Entity\Vehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'plateNumber',
                TextType::class,
                [
                    'label' => 'Рег. номер:',
                    'attr' => ['placeholder' => 'Рег. номер'],
                ]
            )
            ->add(
                'carMake',
                TextType::class,
                [
                    'label' => 'Марка:',
                    'attr' => ['placeholder' => 'Марка'],
                ]
            )
            ->add(
                'carModel',
                TextType::class,
                [
                    'label' => 'Модел',
                    'attr' => ['placeholder' => 'Модел'],
                ]
            )
            ->add(
                'carYear',
                TextType::class,
                [
                    'label' => 'Година на производство',
                    'attr' => ['placeholder' => 'Година на производство'],
                ]
            )
            ->add(
                'vinNumber',
                TextType::class,
                [
                    'label' => 'Шаси номер',
                    'attr' => ['placeholder' => 'Шаси номер'],
                ]
            )
            ->add(
                'engineNumber',
                TextType::class,
                [
                    'label' => 'ДВГ номер',
                    'attr' => ['placeholder' => 'ДВГ номер'],
                ]
            )
            ->add(
                'carOwner',
                TextType::class,
                [
                    'label' => 'Собственик',
                    'attr' => ['placeholder' => 'Собственик'],
                ]
            )
            ->add(
                'personInCharge',
                TextType::class,
                [
                    'label' => 'Отговорник',
                    'attr' => ['placeholder' => 'Отговорник'],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Vehicle::class,
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
                'csrf_token_id' => 'vehicle_item',
            ]
        );
    }
}
