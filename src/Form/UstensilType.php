<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Ustensil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UstensilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('csrf_token', HiddenType::class, [
                'mapped' => false,
                'data' => $options['csrf_token'], // Incluez le jeton CSRF passé en option
            ])
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('picture', null, [
                'label' => 'Image',
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ustensil::class,
            'csrf_token' => '',
        ]);
    }
}
