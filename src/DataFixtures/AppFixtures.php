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
            $categories[] = $category;

            $category = new Category();
            $category->setName("Entrée");
            $manager->persist($category);
            $categories[] = $category;

            $category = new Category();
            $category->setName("Plat principal");
            $manager->persist($category);
            $categories[] = $category;

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
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Tomate");
            $ingredient->setPicture("/images/ingredients/tomate.png");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Basilic");
            $ingredient->setPicture("/images/ingredients/basilic.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Mozzarella");
            $ingredient->setPicture("/images/ingredients/mozzarella.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Huile de tourneol");
            $ingredient->setPicture("/images/ingredients/huile-tournesol.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Levure chimique");
            $ingredient->setPicture("/images/ingredients/levure-chimique.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Yaourt nature");
            $ingredient->setPicture("/images/ingredients/yaourt-nature.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Farine");
            $ingredient->setPicture("/images/ingredients/farine.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Oeuf");
            $ingredient->setPicture("/images/ingredients/oeuf.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Sucre blanc");
            $ingredient->setPicture("/images/ingredients/sucre-blanc.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Fromage rapé");
            $ingredient->setPicture("/images/ingredients/fromage-rape.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("St Môret");
            $ingredient->setPicture("/images/ingredients/st-moret.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Tomates séchées");
            $ingredient->setPicture("/images/ingredients/tomates-sechees.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Pâtes pennes");
            $ingredient->setPicture("/images/ingredients/pennes.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Ail");
            $ingredient->setPicture("/images/ingredients/ail.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Brocolis");
            $ingredient->setPicture("/images/ingredients/brocolis.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Gingembre");
            $ingredient->setPicture("/images/ingredients/gingembre.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Sauce soja");
            $ingredient->setPicture("/images/ingredients/sauce-soja.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Moutarde");
            $ingredient->setPicture("/images/ingredients/moutarde.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Asperges");
            $ingredient->setPicture("/images/ingredients/asperge.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Aneth");
            $ingredient->setPicture("/images/ingredients/aneth.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Saumon");
            $ingredient->setPicture("/images/ingredients/saumon.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Courgette");
            $ingredient->setPicture("/images/ingredients/courgette.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Lardon");
            $ingredient->setPicture("/images/ingredients/lardon.jpg");
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
            $selectedIngredients = $faker->randomElements($ingredients, $faker->numberBetween(3, 5));
            foreach ($selectedIngredients as $selectedIngredient) {
                $recipe->addIngredient($selectedIngredient);
            }

            // Associer des ustensiles à la recette
            $selectedUstensils = $faker->randomElements($ustensils, $faker->numberBetween(2, 5));
            foreach ($selectedUstensils as $selectedUstensil) {
                $recipe->addUstensil($selectedUstensil);
            }

            // Associer des categories à la recette
            $selectedCategories = $faker->randomElements($categories, $faker->numberBetween(1, 4));
            foreach ($selectedCategories as $selectedCategory) {
                $recipe->addCategory($selectedCategory);
            }

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

            $recipe = new Recipe();
            $recipe->setName("Penne au St Môret");
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

            $recipe = new Recipe();
            $recipe->setName("Brocolis sautés à l'ail et au gingembre");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/brocolis.jpg");
            $recipe->setInstructions("Laver et égoutter les brocolis, les couper en petits bouquets. Peler et hacher finement l'ail, peler et râper le gingembre. Dans une poêle, faire chauffer l'huile à feu vif, ajouter l'ail et le gingembre et faire revenir pendant 1 minute. Ajouter les brocolis et faire sauter pendant environ 5 minutes jusqu'à ce qu'ils soient tendres mais encore croquants. Incorporer la sauce soja et le sucre, faire sauter pendant 1 minute supplémentaire. Servir immédiatement.");
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

            $recipe = new Recipe();
            $recipe->setName("Saumon grillé à la moutarde d'aneth et aux asperges");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/saumon.jpg");
            $recipe->setInstructions("Préchauffer le grill du four. Mélanger la moutarde et l'aneth dans un bol. Badigeonner les filets de saumon avec le mélange. Enfourner pendant 10 minutes. Pendant ce temps, laver et couper les asperges. Les faire cuire dans une poêle avec un peu d'huile d'olive pendant 5 minutes. Servir le saumon grillé avec les asperges.");
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
            $selectedIngredients = $faker->randomElements($ingredients, $faker->numberBetween(3, 5));
            foreach ($selectedIngredients as $selectedIngredient) {
                $recipe->addIngredient($selectedIngredient);
            }

            // Associer des ustensiles à la recette
            $selectedUstensils = $faker->randomElements($ustensils, $faker->numberBetween(2, 5));
            foreach ($selectedUstensils as $selectedUstensil) {
                $recipe->addUstensil($selectedUstensil);
            }

            // Associer des categories à la recette
            $selectedCategories = $faker->randomElements($categories, $faker->numberBetween(1, 4));
            foreach ($selectedCategories as $selectedCategory) {
                $recipe->addCategory($selectedCategory);
            }

            $manager->persist($recipe);
            $recipes[] = $recipe;

            $recipe = new Recipe();
            $recipe->setName("Tortilla à la courgette");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/tortilla.jpg");
            $recipe->setInstructions("Dans une poêle, ajouter 2 filets d'huile d'olive, faire cuire les lardons. Éplucher les courgettes et les couper en petits morceaux, puis les faire cuire avec un filet d'huile d'olive, saler et poivrer. Dans une récipient, battre les 2 oeufs et saler. Ajouter le gruyère, les lardons, les courgettes et la farine, mélanger le tout. Verser la préparation dans une poêle et faire cuire environ 10-15min, déguster chaud !  ");
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

            $recipe = new Recipe();
            $recipe->setName("Brocolis sautés à l'ail et au gingembre");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/brocolis.jpg");
            $recipe->setInstructions("Laver et égoutter les brocolis, les couper en petits bouquets. Peler et hacher finement l'ail, peler et râper le gingembre. Dans une poêle, faire chauffer l'huile à feu vif, ajouter l'ail et le gingembre et faire revenir pendant 1 minute. Ajouter les brocolis et faire sauter pendant environ 5 minutes jusqu'à ce qu'ils soient tendres mais encore croquants. Incorporer la sauce soja et le sucre, faire sauter pendant 1 minute supplémentaire. Servir immédiatement.");
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
