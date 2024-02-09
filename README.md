# O'Fourn'O

L'objectif principal de ce projet est de développer une application de recettes culinaires centrée sur la fonctionnalité de recherche par ingrédients.

Ce repository est l'interface administrateur de l'application O'Fourn'O.

## Installation du Back Office

Après avoir cloné le repository, aller dans le Terminal et taper les lignes de commandes suivantes.

- ```composer install``` sinon ```composer update```

Créer à la racine un fichier ```.env.local```
Copier la ligne suivante : ```DATABASE_URL="mysql://root:root@127.0.0.1:3306/ofourno?serverVersion=10.3.39-MariaDB&charset=utf8mb4"```

Dans le Terminal taper ```mysql -V``` pour connaitre la version, puis modifier la versione de MariaDB dans la ligne de code au dessus.

- ```bin/console doctrine:database:create```
- ```bin/console make:migration```
- ```bin/console doctrine:migrations:migrate``` Doctrine demande si vous etes sur de vouloir écrire des données, répondre ```yes```

- ```bin/console doctrine:schema:validate```
Tout doit apparaitre en vert dans le Terminal.

- ```bin/console doctrine:fixtures:load``` Doctrine demande la aussi si on veu écrire sur la base de donnée, répondre ```yes```
