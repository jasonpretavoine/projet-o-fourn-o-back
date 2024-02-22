<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Recipe;
use App\Entity\Category;
use App\Entity\Ustensil;
use App\Entity\Ingredient;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class RecipeType extends AbstractType
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
                'expanded' => true,
                'by_reference' => false,
                'label' => 'Catégories',
                'label_attr'    => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('ustensils', EntityType::class, [
                'class' => Ustensil::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'label' => 'Ustensiles',
                'label_attr'    => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true, // Ajout de la sélection multiple
                'by_reference' => false,
                'label' => 'Ingrédients',
                'label_attr'    => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'pseudo',
                'label' => 'Utilisateur',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.pseudo', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
            'csrf_token' => '',
        ]);
    }
}
