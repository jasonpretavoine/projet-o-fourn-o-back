<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use App\Entity\Recipe;
use App\Entity\Review;
use App\Entity\Ustensil;
use App\Entity\Category;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Création de 4 catégories
        for ($i = 0; $i < 4; $i++) {
            $category = new Category;
            $category->setName('Catégorie ' . $i);
            $manager->persist($category);
        }


        // Création de 4 ingrédients
        for ($i = 0; $i < 100; $i++) {
            $ingredient = new Ingredient;
            $ingredient->setName('Ingrédient ' . $i);
            $ingredient->setPicture($faker->imageUrl(800, 600));
            for ($j = 0; $j < 2; $j++) {
                $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            }
            $manager->persist($ingredient);
        }


        // Création de 15 recettes
        for ($i = 0; $i < 15; $i++) {
            $recipe = new Recipe();
            $recipe->setName($faker->sentence(3));
            $recipe->setDescription($faker->text(255));
            $recipe->setPicture($faker->imageUrl(800, 600));
            $recipe->setInstructions($faker->text());
            $recipe->setPreparationTime($faker->numberBetween(5, 120));
            $recipe->setCookingTime($faker->numberBetween(5, 120));
            $recipe->setDifficulty($faker->randomElement(['Facile', 'Moyen', 'Difficile']));
            $recipe->setServings($faker->numberBetween(1, 10));
            $recipe->setRating($faker->numberBetween(1, 5));
            $recipe->setStatus($faker->boolean());

            $manager->persist($recipe);
        }

        // Création de 10 utilisateurs
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setUsername($faker->name(2));
            $user->setPseudo($faker->userName(1));
            $user->setPassword($faker->password());
            $user->setEmail($faker->email());
            $user->setRole($faker->randomElement(['USER', 'ADMIN']));
            $manager->persist($user);
        }


        // Création de 20 avis
        for ($i = 0; $i < 20; $i++) {
            $review = new Review();
            $review->setText($faker->text(255));
            $review->setRating($faker->numberBetween(1, 5));
            $manager->persist($review);
        }


        // Création de 15 ustensiles
        for ($i = 0; $i < 15; $i++) {
            $ustensil = new Ustensil();
            $ustensil->setName('Ustensiles ' . $i);
            $ustensil->setPicture($faker->imageUrl(800, 600));
            $manager->persist($ustensil);
        }

        $manager->flush();
    }
}
