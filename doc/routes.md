## Liste des routes exploitables : 

Racine : ```http://localhost/projet-o-fourn-o-back/public/``` , adapter l'hôte.


### Recettes

| Descriptions              | Routes                                      |
| ------------------------- | ------------------------------------------- |
| Toutes les recettes       | ```/api/recipes/view```                     |
| Recette par Id            | ```/api/recipe/(Id_de_la_recette)```        |
| 5 recettes aléatoires     | ```/api/recipes/random```                   |
| Mise à jour d'un recette  | ```/api/recipe/(Id_de_la_recette)/update``` |
| Crée une nouvelle recette | ```/api/recipe/create```                    |


### Ingrédients

| Descriptions         | Routes                                     |
| -------------------- | ------------------------------------------ |
| Tous les ingrédients | ```/api/ingredients/view```                |
| Ingrédient par Id    | ```/api/ingredient/(Id_de_l_ingredient)``` |

### Ustensiles

| Descriptions        | Routes                                  |
| ------------------- | --------------------------------------- |
| Tous les ustensiles | ```/api/ustensils/view```               |
| Ustensiles par Id   | ```/api/ustensil/(Id_de_l_ustensile)``` |

### Utilisateurs

| Descriptions          | Routes                                |
| --------------------- | ------------------------------------- |
| Tous les utilisateurs | ```/api/users/view```                 |
| Utilisateur par Id    | ```/api/user/(Id_de_l_utilisateur)``` |
| Crée un utilisateur   | ```/api/user/create```                |

### Commentaires

| Descriptions                 | Routes                                               |
| ---------------------------- | ---------------------------------------------------- |
| Tous les commentaires        | ```/api/reviews/view```                              |
| Commentaire par Id           | ```/api/review/(Id_du_commentaire)```                |
| Mise à jour d'un commentaire | ```/api/review/(Id_du_commentaire)/update```         |
| Création d'un commentaire    | ```/api/recipes/(Id_du_commentaire)/review/create``` |