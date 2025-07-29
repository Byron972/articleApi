# API Articles - Documentation

Une API REST complète pour la gestion d'articles développée avec Laravel 12.

## 📋 Table des matières

- [Aperçu](#aperçu)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Structure de la base de données](#structure-de-la-base-de-données)
- [Endpoints de l'API](#endpoints-de-lapi)
- [Exemples d'utilisation](#exemples-dutilisation)
- [Codes de réponse](#codes-de-réponse)
- [Gestion des erreurs](#gestion-des-erreurs)
- [Tests](#tests)
- [Contribution](#contribution)

## 🚀 Aperçu

Cette API permet de gérer une collection d'articles avec les fonctionnalités CRUD complètes :
- Créer un article
- Lire un ou plusieurs articles
- Mettre à jour un article
- Supprimer un article

### Technologies utilisées

- **Framework** : Laravel 12.0
- **PHP** : 8.2+
- **Base de données** : MySQL
- **Authentification** : Laravel Sanctum
- **Format de réponse** : JSON

## 📋 Prérequis

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 18 (pour les assets front-end)

## ⚙️ Installation

1. **Cloner le repository**
```bash
git clone <url-du-repository>
cd articleApi
```

2. **Installer les dépendances PHP**```bash
composer install
```

3. **Installer les dépendances Node.js**
```bash
npm install
```

4. **Copier le fichier d'environnement**
```bash
cp .env.example .env
```

5. **Générer la clé d'application**
```bash
php artisan key:generate
```

6. **Configurer la base de données**
Modifier le fichier `.env` avec vos paramètres de base de données :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Article-Api
DB_USERNAME=root
DB_PASSWORD=
```

7. **Exécuter les migrations**
```bash
php artisan migrate
```

8. **Démarrer le serveur de développement**
```bash
php artisan serve
```

L'API sera accessible sur `http://localhost:8000`

## 🔧 Configuration

### Variables d'environnement principales

```env
APP_NAME=Api-Article
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Article-Api
DB_USERNAME=root
DB_PASSWORD=
```

## 🗃️ Structure de la base de données

### Table `articles`

| Colonne    | Type      | Description                    | Contraintes        |
|------------|-----------|--------------------------------|-------------------|
| id         | bigint    | Identifiant unique             | PRIMARY KEY, AUTO_INCREMENT |
| title      | varchar   | Titre de l'article             | NOT NULL, max 255 chars |
| content    | text      | Contenu de l'article           | NOT NULL |
| published  | boolean   | Statut de publication          | DEFAULT false |
| created_at | timestamp | Date de création               | AUTO |
| updated_at | timestamp | Date de dernière modification  | AUTO |

## 🛠️ Endpoints de l'API

Tous les endpoints sont préfixés par `/api/`

### 📖 Lister tous les articles

```http
GET /api/article
```

**Réponse :** 
```json
{
    "success": true,
    "articles": [
        {
            "id": 1,
            "title": "Mon premier article",
            "content": "Contenu de l'article...",
            "published": true,
            "created_at": "2025-07-29T15:30:00.000000Z",
            "updated_at": "2025-07-29T15:30:00.000000Z"
        }
    ]
}
```

### 📄 Afficher un article spécifique

```http
GET /api/article/{id}
```

**Paramètres :**
- `id` (integer) : Identifiant de l'article

**Réponse :**
```json
{
    "success": true,
    "article": {
        "id": 1,
        "title": "Mon premier article",
        "content": "Contenu de l'article...",
        "published": true,
        "created_at": "2025-07-29T15:30:00.000000Z",
        "updated_at": "2025-07-29T15:30:00.000000Z"
    }
}
```

### ✍️ Créer un nouvel article

```http
POST /api/article
```

**Headers :**
```
Content-Type: application/json
Accept: application/json
```

**Corps de la requête :**
```json
{
    "title": "Titre de l'article",
    "content": "Contenu détaillé de l'article...",
    "published": true
}
```

**Validation :**
- `title` : obligatoire, string, maximum 255 caractères
- `content` : obligatoire, string
- `published` : optionnel, boolean (défaut: false)

**Réponse (201) :**
```json
{
    "success": true,
    "article": {
        "id": 2,
        "title": "Titre de l'article",
        "content": "Contenu détaillé de l'article...",
        "published": true,
        "created_at": "2025-07-29T16:00:00.000000Z",
        "updated_at": "2025-07-29T16:00:00.000000Z"
    }
}
```

### ✏️ Mettre à jour un article

```http
PUT /api/article/{id}
```

**Paramètres :**
- `id` (integer) : Identifiant de l'article

**Headers :**
```
Content-Type: application/json
Accept: application/json
```

**Corps de la requête :**
```json
{
    "title": "Titre modifié",
    "content": "Contenu modifié...",
    "published": false
}
```

**Réponse (200) :**
```json
{
    "success": true,
    "message": "Article modifié avec succès",
    "article": {
        "id": 1,
        "title": "Titre modifié",
        "content": "Contenu modifié...",
        "published": false,
        "created_at": "2025-07-29T15:30:00.000000Z",
        "updated_at": "2025-07-29T16:15:00.000000Z"
    }
}
```
### 🗑️ Supprimer un article

```http
DELETE /api/article/{id}
```

**Paramètres :**
- `id` (integer) : Identifiant de l'article

**Réponse (200) :**
```json
{
    "success": true,
    "message": "Article supprimé avec succès",
    "article": {
        "id": 1,
        "title": "Titre de l'article",
        "content": "Contenu...",
        "published": true,
        "created_at": "2025-07-29T15:30:00.000000Z",
        "updated_at": "2025-07-29T16:15:00.000000Z"
    }
}
```

## 💡 Exemples d'utilisation

### Avec cURL

**Créer un article :**
```bash
curl -X POST http://localhost:8000/api/article \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Mon nouvel article",
    "content": "Ceci est le contenu de mon article.",
    "published": true
  }'
```

**Récupérer tous les articles :**
```bash
curl -X GET http://localhost:8000/api/article \
  -H "Accept: application/json"
```

**Mettre à jour un article :**
```bash
curl -X PUT http://localhost:8000/api/article/1 \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "title": "Titre mis à jour",
    "content": "Contenu mis à jour.",
    "published": false
  }'
```

### Avec JavaScript (Fetch API)

```javascript
// Créer un article
const createArticle = async () => {
  const response = await fetch('http://localhost:8000/api/article', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      title: 'Mon article via JavaScript',
      content: 'Contenu créé avec JavaScript',
      published: true
    })
  });
  
  const data = await response.json();
  console.log(data);
};

// Récupérer tous les articles
const getArticles = async () => {
  const response = await fetch('http://localhost:8000/api/article', {
    headers: {
      'Accept': 'application/json'
    }
  });
  
  const data = await response.json();
  console.log(data.articles);
};
```

## 📊 Codes de réponse

| Code | Description |
|------|-------------|
| 200  | Succès |
| 201  | Créé avec succès |
| 400  | Erreur de validation |
| 404  | Ressource non trouvée |
| 422  | Erreur de validation des données |
| 500  | Erreur serveur |

## ⚠️ Gestion des erreurs

### Erreur de validation (422)

```json
{
    "success": false,
    "message": "The given data was invalid.",
    "errors": {
        "title": [
            "The title field is required."
        ],
        "content": [
            "The content field is required."
        ]
    }
}
```

### Article non trouvé (404)

```json
{
    "success": false,
    "message": "Article not found"
}
```

## 🧪 Tests

### Exécuter les tests

```bash
# Tests unitaires
php artisan test

# Tests avec couverture
php artisan test --coverage
```

### Tests API avec Postman

Une collection Postman est disponible dans le dossier `/docs` avec tous les endpoints pré-configurés.

## 🔐 Sécurité

- Validation stricte des données d'entrée
- Protection contre l'injection SQL via Eloquent ORM
- Authentification via Laravel Sanctum (prête à être activée)
- Gestion des erreurs sécurisée

## 🚀 Déploiement

### Production

1. **Configurer l'environnement de production**
```bash
APP_ENV=production
APP_DEBUG=false
```

2. **Optimiser l'application**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Configurer le serveur web** (Apache/Nginx) pour pointer vers `/public`

## 🤝 Contribution

1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👥 Auteurs

- **Votre nom** - *Développement initial*

## 📞 Support

Pour toute question ou problème, n'hésitez pas à :
- Ouvrir une issue sur GitHub
- Contacter l'équipe de développement

---

**Version de l'API** : 1.0.0  
**Dernière mise à jour** : 29 juillet 2025