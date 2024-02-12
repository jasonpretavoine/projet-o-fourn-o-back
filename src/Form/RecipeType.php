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
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('picture', null, [
                'label' => 'Image',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('instructions', null, [
                'label' => 'Instructions',
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulté',
                'choices' => [
                    'Facile' => 'facile',
                    'Moyen' => 'moyen',
                    'Difficile' => 'difficile',
                ],
            ])
            ->add('preparationTime', null, [
                'label' => 'Temps de préparation',
            ])
            ->add('cookingTime', null, [
                'label' => 'Temps de cuisson',
            ])
            ->add('servings', ChoiceType::class, [
                'label' => 'Nombre de personnes',
                'choices' => array_combine(range(1, 10), range(1, 10)),
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'Note',
                'choices' => array_combine(range(1, 5), range(1, 5))
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Validé' => '0',
                    'Rejeté' => '1',
                    'En attente de modération' => '2',
                ],
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Catégories',
            ])
            ->add('ustensils', EntityType::class, [
                'class' => Ustensil::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Ustensiles',
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Ingrédients',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'pseudo',
                'label' => 'Utilisateur',
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
