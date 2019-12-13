<?php

namespace App\Form;

use App\Entity\Vehicle;
use App\Entity\VehicleDetails;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleDetailsType extends AbstractType
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
                    'label' => 'Текущи километри',
                ]
            )
            ->add(
                'motoHours',
                TextType::class,
                [
                    'label' => 'Мото часове',
                ]
            )
            ->add(
                'vehicle',
                EntityType::class,
                [
                    'class' => Vehicle::class,
                    'label' => 'Рег. номер:',
                    'required' => false,
                    'data' => '',
                    'choice_label' => 'plateNumber',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => VehicleDetails::class,
            ]
        );
    }
}
