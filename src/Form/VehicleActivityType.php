<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\VehicleActivity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'createdAt',
                DateType::class,
                [
                    'label' => 'Дата:',
                    'disabled' => true,
                    'data' => new \DateTime(),
                    'widget' => 'single_text',
                    'html5' => false,
                ]
            )
            ->add(
                'odometer',
                TextType::class,
                [
                    'label' => 'Текущи км.:',
                ]
            )
            ->add(
                'work',
                TextType::class,
                [
                    'label' => 'Труд:',
                ]
            )
            ->add(
                'parts',
                TextType::class,
                [
                    'label' => 'Части:',
                ]
            )
            ->add(
                'serviz',
                TextType::class,
                [
                    'label' => 'Сервиз:',
                ]
            )
            ->add(
                'supplier',
                TextType::class,
                [
                    'label' => 'Снабдител:',
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Описание:',
                ]
            )
            ->add(
                'activity',
                EntityType::class,
                [
                    'class' => Activity::class,
                    'choice_label' => 'name',
                    'label' => 'Дейност:',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => VehicleActivity::class,
            ]
        );
    }
}
