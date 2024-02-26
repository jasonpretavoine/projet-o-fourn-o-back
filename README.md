# O'Fourn'O

L'objectif principal de ce projet est de développer une application de recettes culinaires centrée sur la fonctionnalité de recherche par ingrédients.

Ce repository est l'interface administrateur de l'application O'Fourn'O.

## Installation du Back Office

Après avoir cloné le repository, aller dans le Terminal, tapez les lignes de commandes suivantes et effectuer les opérations demandées.

Se placer dans la branche ```develop``` avec la commande ```git checkout develop```

- Dans le Terminal, tapez ```composer install```

Créer à la racine un fichier ```.env.local```

Copier à l'intérieur de ce fichier les lignes suivantes : 

```DATABASE_URL="mysql://root:root@127.0.0.1:3306/ofourno?serverVersion=10.3.39-MariaDB&charset=utf8mb4"```
```APP_SECRET=b7b293ec669148d5c9e6a72cd369f971```
```JWT_PASSPHRASE=47abcb10c9ca0536285214085819321db8be98bfc38d5ceb4b14138a84e571ba```

Dans le Terminal tapez ```mysql -V``` pour connaitre la version de Mysql, puis modifier la version de MariaDB dans la ligne de code au dessus.

- Dans le Terminal tapez ```bin/console doctrine:database:create```
  
- Puis ```bin/console doctrine:migrations:migrate``` 
  
Doctrine demande si on est sur de vouloir excécuter la migration, répondre ```yes```

- Ensuite tapez ```bin/console doctrine:fixtures:load``` 
  
Doctrine demande si on veut purger la base de donnée, répondre ```yes```

Le backoffice est installé.

