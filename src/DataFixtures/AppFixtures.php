<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Recipe;
use App\Entity\Ingredient;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Review;
use App\Entity\Ustensil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager, )
    {
        $faker = Factory::create('fr_FR');

        // Tableaux pour stocker les entités
        $users = [];
        $recipes = [];
        $ingredients = [];
        $ustensils = [];
        $categories = [];
        

        // Charger les utilisateurs    
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPseudo($faker->firstName);
            $user->setEmail('admin@admin.com');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword('$2y$13$120hw7dkuZP41vVUNn5lH.Z8xZ4qpamoeN.Kx20ljIkFe86xBGqXO');
            $manager->persist($user);

            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPseudo($faker->firstName);
            $user->setEmail('moderator@moderator.com');
            $user->setRoles(['ROLE_MODERATOR']);
            $user->setPassword('$2y$13$5Avbi4FCck9XHQTxeuk0G.rC.rcdbcav1tdEiKxj90t7vstSc1uqK');
            $manager->persist($user);

            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPseudo($faker->firstName);
            $user->setEmail('user@user.com');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword('$2y$13$YvnLksuP9.Hr/vz70jDJje4UJbrdu55qG952iU6UQ.uJjaEVZL6cO');
            $manager->persist($user);

            $manager->persist($user);
            $users[] = $user;

        $manager->flush();

        // Charger les catégories
        for ($i = 0; $i < 4; $i++) {
            $category = new Category();
            $category->setName($faker->word);

            $manager->persist($category);
            $categories[] = $category;
        }

        $manager->flush();

        // Charger les ingrédients
        for ($i = 0; $i < 100; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName('Ingrédient ' . $i);
            $ingredient->setPicture($faker->imageUrl(800, 600));
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));

            $manager->persist($ingredient);
            $ingredients[] = $ingredient;
        }

        $manager->flush();

        // Charger les ustensiles
        for ($i = 0; $i < 15; $i++) {
            $ustensil = new Ustensil();
            $ustensil->setName($faker->unique()->word);
            $ustensil->setPicture($faker->imageUrl(800, 600));

            $manager->persist($ustensil);
            $ustensils[] = $ustensil;
        }

        $manager->flush();

        // Charger les recettes
        for ($i = 0; $i < 50; $i++) {
            $recipe = new Recipe();
            $recipe->setName($faker->unique()->sentence(3));
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture($faker->imageUrl());
            $recipe->setInstructions($faker->paragraph(4));
            $recipe->setPreparationTime($faker->numberBetween(10, 60));
            $recipe->setCookingTime($faker->numberBetween(20, 120));
            $recipe->setDifficulty($faker->randomElement(['Facile', 'Moyen', 'Difficile']));
            $recipe->setServings($faker->numberBetween(1, 10));
            $recipe->setRating($faker->numberBetween(1, 5));
            $recipe->setStatus($faker->boolean);

            // Associer la recette à un utilisateur existant
            $randomUser = $faker->randomElement($users);
            $recipe->setUser($randomUser);

            // Associer des ingrédients à la recette
            $selectedIngredients = $faker->randomElements($ingredients, $faker->numberBetween(1, 5));
            foreach ($selectedIngredients as $selectedIngredient) {
                $recipe->addIngredient($selectedIngredient);
            }

            // Associer des ustensiles à la recette
            $selectedUstensils = $faker->randomElements($ustensils, $faker->numberBetween(1, 5));
            foreach ($selectedUstensils as $selectedUstensil) {
                $recipe->addUstensil($selectedUstensil);
            }

            // Associer des categories à la recette
            $selectedCategories = $faker->randomElements($categories, $faker->numberBetween(1, 3));
            foreach ($selectedCategories as $selectedCategory) {
                $recipe->addCategory($selectedCategory);
            }
            

            

            $manager->persist($recipe);
            $recipes[] = $recipe;
        }


        $manager->flush();

        // Charger les avis
        for ($i = 0; $i < 100; $i++) {
            $review = new Review();
            $review->setText($faker->paragraph);
            $review->setRating($faker->numberBetween(1, 5));
            $review->setUser($faker->randomElement($users)); // Add this line
            $review->setRecipe($faker->randomElement($recipes));
            $review->setStatus($faker->boolean);

            $manager->persist($review);
        }

        $manager->flush();
    }
}
