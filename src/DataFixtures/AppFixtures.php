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

            $ingredient = new Ingredient();
            $ingredient->setName("Bouillon de volaille");
            $ingredient->setPicture("/images/ingredients/bouillon.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Crème liquide");
            $ingredient->setPicture("/images/ingredients/creme-liquide.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Eau");
            $ingredient->setPicture("/images/ingredients/eau.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Carotte");
            $ingredient->setPicture("/images/ingredients/carotte.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Oignon");
            $ingredient->setPicture("/images/ingredients/oignon.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Poireau");
            $ingredient->setPicture("/images/ingredients/poireau.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Sucre vanillé");
            $ingredient->setPicture("/images/ingredients/sucre-vanille.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Pruneau");
            $ingredient->setPicture("/images/ingredients/pruneau.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Maïs");
            $ingredient->setPicture("/images/ingredients/mais.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Wrap");
            $ingredient->setPicture("/images/ingredients/wrap.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Avocat");
            $ingredient->setPicture("/images/ingredients/avocat.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Beurre");
            $ingredient->setPicture("/images/ingredients/beurre.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Poudre d'amande");
            $ingredient->setPicture("/images/ingredients/poudre-amande.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;

            $ingredient = new Ingredient();
            $ingredient->setName("Pâte feuilletée");
            $ingredient->setPicture("/images/ingredients/pate-feuilletee.jpg");
            $ingredient->setMetricUnit($faker->randomElement(['g', 'kg', 'ml', 'cl', 'l']));
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;
        
        $manager->flush();

        // Charger les ustensiles
            $ustensil = new Ustensil();
            $ustensil->setName("Pince à salade");
            $ustensil->setPicture("/images/ustensils/pince.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Rape à fromage");
            $ustensil->setPicture("/images/ustensils/rape.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Fouet");
            $ustensil->setPicture("/images/ustensils/fouet.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Cuillère à soupe");
            $ustensil->setPicture("/images/ustensils/cuillere.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Plat à gratin");
            $ustensil->setPicture("/images/ustensils/plat-gratin.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Plat à rotir");
            $ustensil->setPicture("/images/ustensils/plat-rotir.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Poche à douille");
            $ustensil->setPicture("/images/ustensils/poche-douille.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Passoire chinois");
            $ustensil->setPicture("/images/ustensils/chinois.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Poêle");
            $ustensil->setPicture("/images/ustensils/poele.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Passoire");
            $ustensil->setPicture("/images/ustensils/passoire.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Casserole");
            $ustensil->setPicture("/images/ustensils/casserole.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Spatule");
            $ustensil->setPicture("/images/ustensils/spatule.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Plat à tarte");
            $ustensil->setPicture("/images/ustensils/plat.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Couteau de cuisine");
            $ustensil->setPicture("/images/ustensils/couteau.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

            $ustensil = new Ustensil();
            $ustensil->setName("Louche");
            $ustensil->setPicture("/images/ustensils/louche.jpg");
            $manager->persist($ustensil);
            $ustensils[] = $ustensil;

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
            $selectedCategories = $faker->randomElements($categories, $faker->numberBetween(1, 3));
            foreach ($selectedCategories as $selectedCategory) {
                $recipe->addCategory($selectedCategory);
            }

            $manager->persist($recipe);
            $recipes[] = $recipe;

            $recipe = new Recipe();
            $recipe->setName("Soupe veloutée aux légumes");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/soupe.jpg");
            $recipe->setInstructions("Éplucher les carottes et les couper en rondelles pas trop grosses afin qu'elles cuisent plus vite. Éplucher le poireau en morceaux et couper l'oignon, puis écraser la gousse d'ail. Verser l’eau dans la marmite et y plonger tous les légumes, les faire revenir 5 min en ajoutant 3 cuillères à soupe d'huile d'olive. Verser le bouillon de volaille sur les légumes. Cuire pendant au moins 1h15. Vérifier qu'il ne manque pas d'eau et ajouter du temps de cuisson si les carottes ne sont pas assez cuites pour être mixées. Une fois tous les légumes cuits, mixer tout en ajouter la crème liquide. Assaisonner à votre goût.");
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
            $selectedCategories = $faker->randomElements($categories, $faker->numberBetween(1, 3));
            foreach ($selectedCategories as $selectedCategory) {
                $recipe->addCategory($selectedCategory);
            }

            $manager->persist($recipe);
            $recipes[] = $recipe;

            $recipe = new Recipe();
            $recipe->setName("Flan aux pruneaux moelleux");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/flan.jpg");
            $recipe->setInstructions("Dans un saladier, mélanger la farine, le sucre en poudre et le sachet de sucre vanillé, y ajouter les œufs et battre la préparation. Faire tiédir le lait dans une casserole, mettre ensuite les pruneaux dénoyautés dedans. Ajoutez les 2 préparations dans un seul saladier et remuer doucement jusqu'à obtenir une pâte homogène, verser un plat et enfourner pendant 40 min à 180°C (thermostat 6). Servir tiède en saupoudrant de sucre glace.");
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
            $recipe->setName("Wrap de tomate et avocat");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/wrap.jpg");
            $recipe->setInstructions("Découper la tomate et un demi avocat en morceaux. Laver et égoutter le mais. Dans une assiette déposer 2 wraps, puis les morceaux de tomates, d'avocats et le maïs. Assaisonner à votre gout.");
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
            $recipe->setName("Galette frangipane");
            $recipe->setDescription($faker->paragraph(2));
            $recipe->setPicture("/images/recipes/frangipane.jpg");
            $recipe->setInstructions("Pré-chauffer le four à 200°C. Sur une plaque allant au four, déposer une feuille de papier sulfurisé dessus. Placer la pâte feuilletée et piquer la avec une fourchette. Dans un saladier, ajouter la poudre d'amande, le sucre, les 2 oeufs et le beurre mou, mélanger le tout. Une fois l'obtention d'une pâte, l'étalé sur la pâte feuilletée, n'oublier pas de placer la fève à l'intérieur. Recouvrir le tout avec la 2ème pâte feuilletée en appuyant bien sur les bords pour ne pas qu'elle se décolle. Faire des dessins sur le dessus de la pâte et badigeonner avec le jaune d'oeuf à l'aide d'un pinceau. Enfourner pendant une vingtaine de minutes en vérifiant régulièrement la cuisson.");
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

        $manager->flush();

        // Charger les avis
        for ($i = 0; $i < 100; $i++) {
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
