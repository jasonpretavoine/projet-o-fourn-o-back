<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Recipe;
use App\Entity\Category;
use App\Entity\Ustensil;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('description')
            ->add('instructions')
            ->add('difficulty', ChoiceType::class, [
                'choices' => [
                    'Facile' => 'facile',
                    'Moyen' => 'moyen',
                    'Difficile' => 'difficile',
                ],
            ])
            ->add('preparationTime')
            ->add('cookingTime')
            ->add('servings', ChoiceType::class, [
                'label' => 'Nombre de personnes',
                'choices' => array_combine(range(1, 10), range(1, 10)),
            ])
             
            ->add('rating', ChoiceType::class, [
                'choices' => array_combine(range(1, 5), range(1, 5))
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Validé' => 'Validé',
                    'Rejeté' => 'Rejeté',
                    'En attente de modération' => 'En attente de modération',
                ],
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'name',
'multiple' => true,
            ])
            ->add('ustensils', EntityType::class, [
                'class' => Ustensil::class,
'choice_label' => 'name',
'multiple' => true,
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
'choice_label' => 'name',
'multiple' => true,
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'pseudo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
