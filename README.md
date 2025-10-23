<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Endpoints de l'API de Gestion de Comptes

Cette section documente les endpoints de l'API pour la gestion des comptes.

### 1. Lister tous les comptes

Permet de récupérer une liste paginée et filtrable des comptes.

**Règles d'accès :**
*   **Administrateur :** Peut récupérer la liste de tous les comptes.
*   **Client :** Peut récupérer uniquement la liste de ses propres comptes.

**Contraintes :**
*   Seuls les comptes non supprimés sont retournés (via un scope global `nonDeleted`).
*   Les comptes de type `epargne` ou `cheque` sont inclus.
*   Un compte épargne peut être actif ou inactif.

**URL de base :**
`http://127.0.0.1:8000/api/v1`

**Endpoint :**
`GET /comptes`

**Paramètres de requête (Query Parameters) :**

| Paramètre    | Type     | Description                                                              | Défaut | Valeurs possibles                               |
| :----------- | :------- | :----------------------------------------------------------------------- | :----- | :---------------------------------------------- |
| `page`       | `integer`| Numéro de la page à récupérer.                                           | `1`    | `1, 2, 3, ...`                                  |
| `limit`      | `integer`| Nombre d'éléments par page.                                              | `10`   | `1` à `100`                                     |
| `type`       | `string` | Filtrer les comptes par type.                                            | `null` | `epargne`, `cheque`                             |
| `statut`     | `string` | Filtrer les comptes par statut.                                          | `null` | `actif`, `bloque`, `ferme`                      |
| `search`     | `string` | Recherche par numéro de compte ou nom du titulaire.                      | `null` | Toute chaîne de caractères                      |
| `sort`       | `string` | Champ sur lequel trier les résultats.                                    | `dateCreation` | `dateCreation`, `solde`, `titulaire`            |
| `order`      | `string` | Ordre de tri.                                                            | `desc` | `asc`, `desc`                                   |

**Exemple de requête (Postman) :**

```http
GET http://127.0.0.1:8000/api/v1/comptes?page=1&limit=10&type=epargne&statut=actif&search=Client&sort=dateCreation&order=desc
Host: 127.0.0.1:8000
Authorization: Bearer {token_d_authentification}
Accept: application/json
```

*   Remplacez `{token_d_authentification}` par un jeton d'accès valide (pour un administrateur ou un client).

**Exemple de réponse (JSON) :**

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "numeroCompte": "C00123456",
            "titulaire": "Client One",
            "type": "epargne",
            "solde": 950000,
            "devise": "XOF",
            "dateCreation": "2023-01-15T00:00:00.000000Z",
            "statut": "actif",
            "metadata": {
                "derniereModification": "2023-10-23T12:23:00.000000Z",
                "version": 1
            }
        }
    ],
    "pagination": {
        "currentPage": 1,
        "totalPages": 1,
        "totalItems": 1,
        "itemsPerPage": 10,
        "hasNext": false,
        "hasPrevious": false
    },
    "links": {
        "self": "http://127.0.0.1:8000/api/v1/comptes?page=1",
        "next": null,
        "first": "http://127.0.0.1:8000/api/v1/comptes?page=1",
        "last": "http://127.0.0.1:8000/api/v1/comptes?page=1"
    }
}

### 2. Lister tous les comptes non archivés

Permet de récupérer une liste paginée et filtrable des comptes qui ne sont pas archivés.

**Règles d'accès :**
*   **Administrateur :** Peut récupérer la liste de tous les comptes non archivés.
*   **Client :** Peut récupérer uniquement la liste de ses propres comptes non archivés.

**Contraintes :**
*   Seuls les comptes non supprimés et non archivés sont retournés.

**URL de base :**
`http://127.0.0.1:8000/api/v1`

**Endpoint :**
`GET /comptes/non-archives`

**Paramètres de requête (Query Parameters) :**

| Paramètre    | Type     | Description                                                              | Défaut | Valeurs possibles                               |
| :----------- | :------- | :----------------------------------------------------------------------- | :----- | :---------------------------------------------- |
| `page`       | `integer`| Numéro de la page à récupérer.                                           | `1`    | `1, 2, 3, ...`                                  |
| `limit`      | `integer`| Nombre d'éléments par page.                                              | `10`   | `1` à `100`                                     |
| `type`       | `string` | Filtrer les comptes par type.                                            | `null` | `epargne`, `cheque`                             |
| `search`     | `string` | Recherche par numéro de compte ou nom du titulaire.                      | `null` | Toute chaîne de caractères                      |
| `sort`       | `string` | Champ sur lequel trier les résultats.                                    | `dateCreation` | `dateCreation`, `solde`, `titulaire`            |
| `order`      | `string` | Ordre de tri.                                                            | `desc` | `asc`, `desc`                                   |

**Exemple de requête (Postman) :**

```http
GET http://127.0.0.1:8000/api/v1/comptes/non-archives?page=1&limit=10&type=epargne&search=Client&sort=dateCreation&order=desc
Host: 127.0.0.1:8000
Authorization: Bearer {token_d_authentification}
Accept: application/json
```

*   Remplacez `{token_d_authentification}` par un jeton d'accès valide.

**Exemple de réponse (JSON) :**

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "numeroCompte": "C00123456",
            "titulaire": "Client One",
            "type": "epargne",
            "solde": 950000,
            "devise": "XOF",
            "dateCreation": "2023-01-15T00:00:00.000000Z",
            "statut": "actif",
            "metadata": {
                "derniereModification": "2023-10-23T12:23:00.000000Z",
                "version": 1
            }
        }
    ],
    "pagination": {
        "currentPage": 1,
        "totalPages": 1,
        "totalItems": 1,
        "itemsPerPage": 10,
        "hasNext": false,
        "hasPrevious": false
    },
    "links": {
        "self": "http://127.0.0.1:8000/api/v1/comptes/non-archives?page=1",
        "next": null,
        "first": "http://127.0.0.1:8000/api/v1/comptes/non-archives?page=1",
        "last": "http://127.0.0.1:8000/api/v1/comptes/non-archives?page=1"
    }
}

### 3. Lister tous les comptes archivés

Permet de récupérer une liste paginée et filtrable des comptes qui sont archivés.

**Règles d'accès :**
*   **Administrateur :** Peut récupérer la liste de tous les comptes archivés.
*   **Client :** Peut récupérer uniquement la liste de ses propres comptes archivés.

**Contraintes :**
*   Seuls les comptes supprimés et archivés sont retournés.

**URL de base :**
`http://127.0.0.1:8000/api/v1`

**Endpoint :**
`GET /comptes/archives`

**Paramètres de requête (Query Parameters) :**

| Paramètre    | Type     | Description                                                              | Défaut | Valeurs possibles                               |
| :----------- | :------- | :----------------------------------------------------------------------- | :----- | :---------------------------------------------- |
| `page`       | `integer`| Numéro de la page à récupérer.                                           | `1`    | `1, 2, 3, ...`                                  |
| `limit`      | `integer`| Nombre d'éléments par page.                                              | `10`   | `1` à `100`                                     |
| `type`       | `string` | Filtrer les comptes par type.                                            | `null` | `epargne`, `cheque`                             |
| `search`     | `string` | Recherche par numéro de compte ou nom du titulaire.                      | `null` | Toute chaîne de caractères                      |
| `sort`       | `string` | Champ sur lequel trier les résultats.                                    | `dateCreation` | `dateCreation`, `solde`, `titulaire`            |
| `order`      | `string` | Ordre de tri.                                                            | `desc` | `asc`, `desc`                                   |

**Exemple de requête (Postman) :**

```http
GET http://127.0.0.1:8000/api/v1/comptes/archives?page=1&limit=10&type=epargne&search=Client&sort=dateCreation&order=desc
Host: 127.0.0.1:8000
Authorization: Bearer {token_d_authentification}
Accept: application/json
```

*   Remplacez `{token_d_authentification}` par un jeton d'accès valide.

**Exemple de réponse (JSON) :**

```json
{
    "success": true,
    "data": [
        {
            "id": 2,
            "numeroCompte": "C00987654",
            "titulaire": "Client Two",
            "type": "courant",
            "solde": 1200000,
            "devise": "XOF",
            "dateCreation": "2023-02-20T00:00:00.000000Z",
            "statut": "ferme",
            "metadata": {
                "derniereModification": "2023-10-23T12:25:00.000000Z",
                "version": 1
            }
        }
    ],
    "pagination": {
        "currentPage": 1,
        "totalPages": 1,
        "totalItems": 1,
        "itemsPerPage": 10,
        "hasNext": false,
        "hasPrevious": false
    },
    "links": {
        "self": "http://127.0.0.1:8000/api/v1/comptes/archives?page=1",
        "next": null,
        "first": "http://127.0.0.1:8000/api/v1/comptes/archives?page=1",
        "last": "http://127.0.0.1:8000/api/v1/comptes/archives?page=1"
    }
}
