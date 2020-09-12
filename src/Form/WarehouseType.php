<?php

namespace App\Form;

use App\Entity\Supplier;
use App\Entity\Warehouse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class WarehouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                null,
                [
                    'constraints' => [
                        new NotBlank(['message' => 'Halo! pusta nazwa?'])
                    ],
                ]
            )
            ->add(
                'supplier',
                EntityType::class,
                [
                    'class' => Supplier::class,
                    'placeholder' => 'Wybierz dostawce',
                    'constraints' => [
                        new NotBlank(['message' => 'Wprowadź dostawce'])
                    ],
//                'choice_label' => 'name'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Warehouse::class,
            ]
        );
    }
}
