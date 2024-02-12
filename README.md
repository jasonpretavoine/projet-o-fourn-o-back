# O'Fourn'O

L'objectif principal de ce projet est de développer une application de recettes culinaires centrée sur la fonctionnalité de recherche par ingrédients.

Ce repository est l'interface administrateur de l'application O'Fourn'O.

## Installation du Back Office

Après avoir cloné le repository, aller dans le Terminal, tapez les lignes de commandes suivantes et effectuer les opérations demandées.

Se placer dans la branche ```develop``` avec la commande ```git checkout develop```

- Dans le Terminal, tapez ```composer install```

Créer à la racine un fichier ```.env.local```

Copier à l'intérieur de ce fichier la ligne suivante : 

```DATABASE_URL="mysql://root:root@127.0.0.1:3306/ofourno?serverVersion=10.3.39-MariaDB&charset=utf8mb4"```

Dans le Terminal tapez ```mysql -V``` pour connaitre la version de Mysql, puis modifier la version de MariaDB dans la ligne de code au dessus.

- Dans le Terminal tapez ```bin/console doctrine:database:create```
  
- Puis ```bin/console doctrine:migrations:migrate``` 
  
Doctrine demande si on est sur de vouloir excécuter la migration, répondre ```yes```

- Ensuite tapez ```bin/console doctrine:fixtures:load``` 
  
Doctrine demande si on veut purger la base de donnée, répondre ```yes```

Le backoffice est installé.

## Liste des routes exploitables : 

http://localhost/projet/projet-o-fourn-o-back/public/

### Recettes

Toutes les recettes : ```/api/recipes/view```

Recette par Id : ```/api/recipe/(Id_de_la_recette)```

### Ingrédients

Tous les ingrédients : ```/api/ingredients/view```

Ingrédient par Id : ```/api/ingredient/(Id_de_l_ingredient)```

### Ustensiles

Tous les ustensiles : ```/api/ustensils/view```

Ustensiles par Id : ```/api/ustensil/(Id_de_l_ustensile)```

### Utilisateurs

Tous les utilisateurs : ```/api/users/view```

Utilisateur par Id : ```/api/user/(Id_de_l_utilisateur)```

### Commentaires

Tous les commentaires : ```/api/reviews/view```

Commentaire par Id : ```/api/review/(Id_du_commentaire)```
