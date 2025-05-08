# CT - Framework Web 2

## Composition du groupe
Prénom | NOM | Adresse universitaire  
Dorian LUDMANN dorian.ludmann@etu.univ-orleans.fr  
Theo Benet-Chapard theo.benet-chapard@etu.univ-orleans.fr  
Ayoub BOUAYA ayoub.bouaya@etu.univ-orleans.fr  
Ayoub BAHI ayoub.bahi@etu.univ-orleans.fr  

## Questions

### Question 1
Les informations des observations seront programmées de façon suivante:  

| Nom du Champ | Type (Symfony) |  
|--------------|----------------|  
| Id_Obs       | int            |  
| Date         | DateTime       |  
| Latitude     | Float          |  
| Longitude    | Float          |  
| Id_Animal    | int            |  
| Description  | String         |  


### Question 2
```bash
symfony console make:entity Animal
symfony console make:entity Observation

symfony console make:migration
symfony console doctrine:migrations:migrate
```

On ajoute une relation ManyToOne(many observations pour one Animal), et on refait une migration.

**API Animal**:
- Collection des ressources: /api/animals (GET)
- Créer d'une ressource: /api/animals (POST)
- Récupérer une ressource: /api/animals/{id} (GET)
- Supprimer une ressource: /api/animals/{id} (DELETE)
- Mettre une ressource à jour: /api/animals/{id} (PATCH)

**API Observations**:
- Collection des ressources: /api/observations (GET)
- Créer d'une ressource: /api/observations (POST)
- Récupérer une ressource: /api/observations/{id} (GET)
- Supprimer une ressource: /api/observations/{id} (DELETE)
- Mettre une ressource à jour: /api/observations/{id} (PATCH)

### Question 3
Création d'une fixture:
```bash
symfony composer require orm-fixtures --dev
symfony console make:fixtures
```

Load:
```bash
symfony console doctrine:fixtures:load
```

### Question 4
Création du composant about
```bash
ng generate component about
```

### Question 5
Ajout de api-response:

```
ng g i api-response
```

### Question 6
```
ng add @angular/material
ng g i animal
ng g c --standalone animals
ng g c --standalone animal-form
ng g c --standalone animal-detail
```

### Question 7
```
ng g c --standalone observation
ng g c --standalone observation-form
ng g c --standalone observation-detail
```

### Question 8
```
ng add @angular/material
ng generate component navbar
```

### Question 9
```
symfony console make:user
symfony composer require "lexik/jwt-authentication-bundle"
symfony console make:listener
ng generate service authentication
ng generate component login
symfony console make:controller
ng generate component registration
```

### Question 10
```
symfony console make:entity Observation
```

### Question 11
Après avoir parlé au sein du groupe des possibilités possibles d'extensions, nous avons pu en retenir 4:
- Un quiz  
    - Prend un animal aléatoire dans la base de données
    - Prend un attribut aléatoire de l'animal
    - Pose une question de type "Quelle est le/la attribut_choisit de l'animal animal_choisi?"
    - Propose quatres choix uniques choisi aléatoirement parmis d'autre valeurs de la base de données
    - Lors du choix, montre la bonne réponse
    - Propose de rejouer 
- Un système de suggestion de pages "A voir aussi":
    - En bas de la page d'un animal, on retrouvera un ensemble d'animal similaire (on opteras au final pour une séléction aléatoire par le peu d'animaux dans la BD actuellement, il suffirais néamoins de changer la requête faites pour match les attributs de l'animal séléctionné)
- Une barre de recherche permettant de filtrer les animaux affichés
- Une carte permettant de visualiser les coordonnées de l'observation selon les données stockées sur une carte du monde

## Question 12
Fix du fait qu'un utilisateur ayant créer une observation ne pouvais pas la voir / modifier.

Ajout du quiz:
1 - Création d'un controleur Symfony
```
php bin/console make:controller QuizController
```
2 - Ajout d'une route entry-point pour générer une question
```
#[Route('/api/quiz-question', name: 'api_quiz_question', methods: ['GET'])]
```

3 - Création d'un component Angular
```
ng g c --standalone quiz
```

Ajout d'une barre de recherche pour les animaux
1 - Ajout de FormsModule et MatToolbarModule dans le component Animal  
2 - Ajout d'un attribut searchText dans le component  
3 - Modification du HTML  

Package pour la carte:
```
npm install leaflet
npm i -D @types/leaflet
```

Les cartes des observations sont disponibles dans leur pages de détail respectives