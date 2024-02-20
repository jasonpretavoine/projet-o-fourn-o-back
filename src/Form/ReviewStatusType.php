<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', null, [
                'disabled' => true, // Pour afficher le commentaire mais le rendre non modifiable
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En attente de modération' => 'pending',
                    'Approuvé' => 'approved',
                    'Rejeté' => 'rejected',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
