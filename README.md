# security-response

link https://www.security-response.fr/

Application développée en équipe lors de l'apothéose avec l'école O'Clock.

Projet réalisé de A à Z, de la conception du cahier des charges au déploiement.

Ce projet a été présenté aux jurys pour le titre professionnel développeur web et web mobile.

<!-- ABOUT THE PROJECT -->
## About The Project

Ce site a pour but de mettre en relation des professionnels de la sécurité informatique avec des entreprises.


### Built With

* 💻 VS Code
* ❤ Symfony
* Leaflet


<!-- USAGE EXAMPLES -->
## Getting Started

```bash


# Install depedencies
composer install


# Because of webpack, install node dependencies
npm install


# Create the database
php bin/console doctrine:database:create


# Apply migrations
php bin/console doctrine:migrations:migrate


# Apply fixtures if needed
php bin/console doctrine:fixtures:load


# Launch a PHP server and enjoy our good work !
symfony server:start
```


### How to use webpack ?

Webpack will create a new folder in the root directory called `assets`.
Inside, you will find a `styles` folder with `app.css` where you need to add your css rules.  
This file is imported in `app.js`, where you can add you own javascripts scripts.  
Everytime you add something in these two files, you need to compile to apply changes.

#### Compile assets with webpack

```bash

# Compile assets once
npm run dev


# Or, recompile assets automatically when files change
npm run watch


# On deploy, create a production file
npm run build
```
