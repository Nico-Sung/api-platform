# 🚀 API Platform E-commerce Project

Ce projet est une API REST complète réalisée avec **Symfony 7** et **API
Platform**.\
Elle permet la gestion de **produits**, **catégories** et
**utilisateurs**, avec un système d'authentification sécurisé via
**JWT**.\
L'ensemble est entièrement conteneurisé avec **Docker**.

## 🛠 Stack Technique

-   **Framework :** Symfony 7
-   **API :** API Platform 3
-   **Base de données :** MySQL 8.0
-   **Serveur Web :** Nginx (Alpine)
-   **Authentification :** LexikJWTAuthenticationBundle
-   **Environnement :** Docker & Docker Compose

## 📋 Prérequis

-   Docker Desktop installé\
-   Un client API : Postman, Insomnia ou Thunder Client

## 🐳 Installation et Démarrage

### 1️⃣ Cloner et configurer

Vérifiez que votre fichier `.env` contient :

``` env
DATABASE_URL="mysql://app:password@database:3306/api_final?serverVersion=8.0.32&charset=utf8mb4"
```

### 2️⃣ Lancer les conteneurs

``` bash
docker-compose up -d --build
```

### 3️⃣ Installer les dépendances

``` bash
docker-compose exec php composer install
```

### 4️⃣ Configurer la Base de Données & la Sécurité

``` bash
docker-compose exec php php bin/console doctrine:database:create --if-not-exists
docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction
docker-compose exec php php bin/console lexik:jwt:generate-keypair --overwrite
docker-compose exec php php bin/console doctrine:fixtures:load --no-interaction
```

✔️ L'API est accessible ici : **http://localhost:8080/api**

## 🧪 Utilisation & Tests

### 🔐 Comptes de test

  **Admin** :
  email : admin@test.com ;
  mot de passe : password ;
  fonctionnalités : CRUD complet ;

  **User** :
  email : user@test.com ;
  mot de passe : password ; 
  fonctionnalités : Lecture + édition de son profil ;

### 📸 Gestion des Médias (Upload)

#### 1. Uploader une image

- **POST** `/api/media`
- **Header :** `Content-Type: multipart/form-data`
- **Body form-data :**  
  - `file` → *(File)*

Réponse :

```json
{
  "@id": "/api/media/15",
  "filePath": "image_upload.jpg"
}
```

#### 2. Associer une image à un produit

Inclure l’IRI ex. `/api/media/15` dans le champ `media`.### 📸 Gestion des Médias (Upload)

#### 1. Uploader une image

- **POST** `/api/media`
- **Header :** `Content-Type: multipart/form-data`
- **Body form-data :**  
  - `file` → *(File)*

Réponse :

```json
{
  "@id": "/api/media/15",
  "filePath": "image_upload.jpg"
}
```

#### 2. Associer une image à un produit

Inclure l’IRI ex. `/api/media/15` dans le champ `media`.

``json
{
  {
  "title": "Produit avec Photo",
  "content": "Ce produit est magnifique",
  "price": 50,
  "quantity": 10,
  "isPublished": true,
  "category": "/api/categories/11",
  "media": "/api/media/21"  
  }
}
```

### 🔑 Authentification (JWT)

**POST** → `http://localhost:8080/api/auth`

Body :

``` json
{
  "email": "admin@test.com",
  "password": "password"
}
```

## 🔍 Filtres et Opérations sur les Produits

-   `GET /api/products?title=Produit`
-   `GET /api/products?price[between]=10..100`
-   `GET /api/products?order[quantity]=desc`
-   `GET /api/products?isPublished=true`

## ⭐ Fonctionnalités Clés

-   State Processor personnalisé
-   Groupes de sérialisation
-   Sécurité avancée
-   Validation stricte

## 📂 Structure du Docker

-   docker-compose.yml\
-   Dockerfile\
-   docker/nginx/default.conf

## 🎓 Projet réalisé dans le cadre d'une évaluation API Platform / Symfony.
