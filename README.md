# ESILAN

Ce projet est la version 2.0 du site de l'Esilan du Club Informatique de l'Esisar.

## Requirement
* [Composer](https://getcomposer.org/download/) )
* Les dépendances de Laravel 5.5 :
    * PHP >= 7.1.3
    * OpenSSL PHP Extension
    * PDO PHP Extension
    * Mbstring PHP Extension
    * Tokenizer PHP Extension
    * XML PHP Extension
    * Ctype PHP Extension
    * JSON PHP Extension

## Installation du projet

    git clone this
    composer install


- Créer un fichier .env à partir de .env.example : ```cp .env.example .env```
- Générer la clef via la commande : ```php artisan key:generate```
- Pointer l'url vers le fichier public/index.php. 
- Renseigner au minimum les champs suivants dans le fichier .env :
    - **APP_ENV** : Par défaut à "local", ce paramètre accepte également la valeur "production".
    - **APP_URL** : URL du site.
    - **DB_CONNECTION** : [mysql|pgsql|sqlite]
    - **DB_HOST** : Addresse de la bdd
    - **DB_PORT** : Port de la bdd
    - **DB_DATABASE** : Nom de la base de donnée (Renseigner le chemin vers le fichier sqlite le cas échéant)
    - **DB_USERNAME** : Nom d'utilisateur
    - **DB_PASSWORD** : Mot de passe de l'utilisateur

- Lancer la migration de la base de données : ```php artisan migrate```