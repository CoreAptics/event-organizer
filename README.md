Base Symfony
========================

Installation de Symfony Standard Edition en version 3.1.6 avec 2 formulaires de login et des routes prédéfinies
pour un BackOffice et un FrontOffice.

Attention le site est encore en dev il est full of bugs.


How to use ?
========================

Prérequis:

* Composer.phar installé et à jour.

Installation:

* <code>composer install</code>

* <code>php bin/console doctrine:database:create</code>

* <code>php bin/console doctrine:schema:create</code>

* <code>php bin/console doctrine:fixtures:load</code>

Ensuite il faudra configurer votre serveur de mail et ajouter votre Email de contact dans les fixtures Parameter. Un csv est à disposition pour ajouter 
des paramètres généraux. 

PRO TIPS: Editez le fichier csv avec OpenOffice Calc et pensez à overwrite les paramètres d'enregistrement pour que l'encodage soit bien en UTF-8 et que les caractères de sépartion soit des ; et ceux de texte
".

Pensez à configurer votre serveur de mail dans parameters.yml

```php
mailer_transport: gmail  
mailer_user: adresse.mail@gmail.com  
mailer_password: xxxxxxx  
mailer_auth: login  
```

Ainsi que le config.yml

```php
swiftmailer: 
    transport: "%mailer_transport%"
    username:  "%mailer_user%"  
    password:  "%mailer_password%"  
    auth_mode: "%mailer_auth%"  
    spool:     { type: memory }  
```

TRES IMPORTANT
==============

A chaque pull réaliser il faut impérativement penser à mettre à jour la base de données, sous peine de se prendre des erreurs

```php
php bin/console doctrine:schema:update --force
```