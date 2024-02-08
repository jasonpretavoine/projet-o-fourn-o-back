<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Users;
use App\Entity\Recipes;
use App\Entity\Categories;
use App\Entity\Ingredients;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends Fixture
{

    private $recipes = [];
    private $users = [];


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Création de 4 catégories
        for ($i = 0; $i < 4; $i++) {
            $categorie = new Categories;
            $categorie->setName('Catégorie ' . $i);
            $manager->persist($categorie);
        }


        // Création de 4 ingrédients
        for ($i = 0; $i < 100; $i++) {
            $ingredient = new Ingredients;
            $ingredient->setName('Ingrédient ' . $i);
            $ingredient->setPicture($faker->imageUrl(800, 600));
            for ($j = 0; $j < 2; $j++) {
                $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            }
            $manager->persist($ingredient);
        }


        // Création de 15 recettes
        for ($i = 0; $i < 15; $i++) {
            $recipe = new Recipes();
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
            $this->recipes[] = $recipe;
        }

        // Création de 10 utilisateurs
        for ($i = 0; $i < 10; $i++) {
            $user = new Users();
            $user->setUsername($faker->userName(2));
            $user->setPseudo($faker->firstName());
            $user->setPassword($faker->password());
            $user->setEmail($faker->email());
            $user->setRole($faker->randomElement([['ROLE_USER'], ['ROLE_ADMIN']]));
            $this->users[] = $user;
            $manager->persist($user);
        }

        $manager->flush();
    }
}
