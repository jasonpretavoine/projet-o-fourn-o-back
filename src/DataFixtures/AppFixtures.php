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
            $category = new Category();
            $category->setName("Apéritif");
            $manager->persist($category);

            $category = new Category();
            $category->setName("Entrée");
            $manager->persist($category);

            $category = new Category();
            $category->setName("Plat principal");
            $manager->persist($category);

            $category = new Category();
            $category->setName("Dessert");
            $manager->persist($category);

            $categories[] = $category;

        $manager->flush();

        // Charger les ingrédients
            $ingredient = new Ingredient();
            $ingredient->setName("Huile d'olive");
            $ingredient->setPicture("/images/ingredients/huile-olive.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Tomate");
            $ingredient->setPicture("/images/ingredients/tomate.png");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Basilic");
            $ingredient->setPicture("/images/ingredients/basilic.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Mozzarella");
            $ingredient->setPicture("/images/ingredients/mozzarella.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Huile de tourneol");
            $ingredient->setPicture("/images/ingredients/huile-tournesol.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Levure chimique");
            $ingredient->setPicture("/images/ingredients/levure-chimique.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Yaourt nature");
            $ingredient->setPicture("/images/ingredients/yaourt-nature.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Farine");
            $ingredient->setPicture("/images/ingredients/farine.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Oeuf");
            $ingredient->setPicture("/images/ingredients/oeuf.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Sucre blanc");
            $ingredient->setPicture("/images/ingredients/sucre-blanc.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Fromage rapé");
            $ingredient->setPicture("/images/ingredients/fromage-rape.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("St Môret");
            $ingredient->setPicture("/images/ingredients/st-moret.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Tomates séchées");
            $ingredient->setPicture("/images/ingredients/tomates-sechees.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredient = new Ingredient();
            $ingredient->setName("Pâtes pennes");
            $ingredient->setPicture("/images/ingredients/pennes.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);

            $ingredients[] = $ingredient;
        
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
            $recipe = new Recipe();
            $recipe->setName("Tartare de tomates et mozzarella di buffala");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/tomate.jpg");
            $recipe->setInstructions("Laver les tomates et les couper en petits cubes. Couper la mozzarella di buffala en petits cubes. Mélanger les tomates et la mozzarella di buffala dans un saladier.Ajouter l'huile d'olive, le basilic, le sel et le poivre et mélanger à nouveau. Réserver au frais jusqu'au moment de servir.");
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
            $randomIngredient = $faker->randomElement($ingredients);
            $recipe->addIngredient($randomIngredient);

            // Associer des ustensiles à la recette
            $randomUstensil = $faker->randomElement($ustensils);
            $recipe->addUstensil($randomUstensil);

            // Associer des categories à la recette
            $randomCategory = $faker->randomElement($categories);
            $recipe->addCategory($randomCategory);

            $manager->persist($recipe);
            $recipes[] = $recipe;

            $recipe = new Recipe();
            $recipe->setName("Gateau aux yaourt");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/gateau.jpg");
            $recipe->setInstructions("Dans un saladier, mélanger la farine, la levure et le sucre. Y ajouter le yaourt. Mélanger. Tout en mélangeant, ajouter les œufs.Introduire l’huile de tournesol. Mélanger. Enfourner à 180/190°C pendant 35 min, régulièrement vérifier que le gâteau ne cuit pas trop sur le dessus. ");
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
            $randomIngredient = $faker->randomElement($ingredients);
            $recipe->addIngredient($randomIngredient);

            // Associer des ustensiles à la recette
            $randomUstensil = $faker->randomElement($ustensils);
            $recipe->addUstensil($randomUstensil);

            // Associer des categories à la recette
            $randomCategory = $faker->randomElement($categories);
            $recipe->addCategory($randomCategory);

            $manager->persist($recipe);
            $recipes[] = $recipe;

            $recipe = new Recipe();
            $recipe->setName("Penne au st moret");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/pennes.jpg");
            $recipe->setInstructions("Faire cuire les penne (al dente), et les laisser refroidir environ 15min. Dans un récipient, mélanger le st moret, les épinards et tomates séchées. Mélanger le tout dans un bol, servir frais en entrée.");
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
            $randomIngredient = $faker->randomElement($ingredients);
            $recipe->addIngredient($randomIngredient);

            // Associer des ustensiles à la recette
            $randomUstensil = $faker->randomElement($ustensils);
            $recipe->addUstensil($randomUstensil);

            // Associer des categories à la recette
            $randomCategory = $faker->randomElement($categories);
            $recipe->addCategory($randomCategory);

            $manager->persist($recipe);
            $recipes[] = $recipe;
    
        $manager->flush();

        // Charger les avis
        for ($i = 0; $i < 15; $i++) {
            $review = new Review();
            $review->setText($faker->paragraph);
            $review->setRating($faker->numberBetween(1, 5));
            $review->setUser($faker->randomElement($users)); // Add this line
            $review->setRecipe($faker->randomElement($recipes));

            $manager->persist($review);
        }

        $manager->flush();
    }
}
