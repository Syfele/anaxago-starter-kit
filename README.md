Anaxago symfony-starter-kit
===================

# Description

Ce projet est un kit de démarage avec :
- Symfony 3.4 minimum
- php 7.1 minimum

La base de données contient deux tables :
- user => pour la gestion et la connexion des utilisateurs 
- project => pour la liste des projets

Les données préchargés sont
- pour les users 

| email     | password    | Role |
| ----------|-------------|--------|
| john@local.com  | john   | ROLE_USER    |
| admin@local.com | admin | ROLE_ADMIN   | 

 - une liste de 3 projets
 
La connexion et l'enregistrement des utilisateurs sont déjà configurés et opérationnels


# Installation
- ```composer install```
- ```composer init-db ```

    - Script personnalisé permet de créer la base de données, de lancer la création du schéma et de précharger les données
    - Ce script peut être réutilisé pour ré-initialiser la base de données à son état initial à tout moment

# Utilisation
| URI     | Method    | Role | Action
| ----------|-------------|--------|-------------|
| /api/projects  | ALL   | ANY    | Lister tous les projets |
| /api/investisment | POST | IS_AUTHENTICATED_FULLY   | Ajouter un montant à emprunter pour l'utlisateur courant |
| /api/list/investments/{user} | GET | IS_AUTHENTICATED_FULLY   | Lister tous les montants à emprunter pour l'utlisateur courant |
| api/thrift | GET | IS_AUTHENTICATED_FULLY   | Lister le montant d'emprunt mensuelle, le montant versé par le SCPI, la force d'épargne pour l'utlisateur courant |