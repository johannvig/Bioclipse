# Bioclipse

## Introduction

Ce projet mené sur l'ensemble du semestre S3 avec pour objectif de concevoir et développer une application web selon des standards professionnels en groupe de 4 personnes. 

## Objectifs du Projet

Les objectifs de ce projet sont de :
- Créer une application au sein d'une équipe en utilisant une approche de développement.
- Clarifier, compléter, collecter et formaliser les besoins à partir d'une description initialement vague ou incomplète.
- Développer une application qui manipule des données et respecte les paradigmes de qualité.

## Sujet du Projet

Développer une application web pour les producteurs alimentaires afin de distribuer leurs produits, avec quatre rôles utilisateurs :

### Visiteur (Utilisateur non connecté)
- Consulter la liste des producteurs.
- Localiser les producteurs sur une carte.
- Filtrer les producteurs par divers critères (type de produit, lieu, distance, etc.).
- Consulter les produits commercialisés par un producteur.

![image](https://github.com/johannvig/Bioclipse/assets/102874093/65de7b51-97c7-42bf-bc4f-270714403c15)

![image](https://github.com/johannvig/Bioclipse/assets/102874093/575990bb-dbeb-4e1e-b523-a10f7fb1361c)


![image](https://github.com/johannvig/Bioclipse/assets/102874093/7c573d68-a27a-4990-a9dd-1501a5c50dbd)

### Client
- Toutes les capacités du Visiteur.
- Créer, modifier, supprimer son compte.
- Commander des produits (paiement et livraison sur place).
- Envoyer des messages (à l'admin, à un producteur).

![image](https://github.com/johannvig/Bioclipse/assets/102874093/fde8cf51-f326-40f5-a81e-0a996bc05e75)
![image](https://github.com/johannvig/Bioclipse/assets/102874093/d21e825d-64bc-4f2e-9219-ec4f216ca210)


![image](https://github.com/johannvig/Bioclipse/assets/102874093/b8239b86-8caf-40ef-8af4-f67771af9e75)


![image](https://github.com/johannvig/Bioclipse/assets/102874093/d781b4b8-4eda-49cd-a804-f17eefab75a2)

![image](https://github.com/johannvig/Bioclipse/assets/102874093/94c21f2d-001b-45d3-b883-da8317d11f9a)

![image](https://github.com/johannvig/Bioclipse/assets/102874093/ac83812a-2c72-49cd-ace3-b5524fd065d4)

![image](https://github.com/johannvig/Bioclipse/assets/102874093/4f906832-3890-426c-9bdc-f9e9db7c89a8)

![image](https://github.com/johannvig/Bioclipse/assets/102874093/6ee63ac6-4e54-4430-bfd2-141ddb6884e6)

### Producteur
- Créer, modifier, supprimer son compte.
- Supprimer des comptes clients lui appartenant.
- Ajouter, supprimer, modifier des produits.
- Gérer les stocks.
- Lister les commandes (en cours, prête, livrée, annulée).
- Modifier le statut d'une commande.
- Créer un PDF pour chaque commande en cours.
- Envoyer des messages (à l'admin, à un client).
- Consulter les messages reçus et y répondre.

![image](https://github.com/johannvig/Bioclipse/assets/102874093/cb41812f-e267-4a0a-aa48-b7c9d9e0e003)

![image](https://github.com/johannvig/Bioclipse/assets/102874093/c8b16127-b2ef-4136-b14c-b2cfd4ee669d)

### Administrateur
- Supprimer des comptes producteurs.
- Consulter les messages reçus et y répondre.
- Envoyer des messages à une liste de diffusion (comptes Client et Producteur).

![image](https://github.com/johannvig/Bioclipse/assets/102874093/7943aeec-b9f7-445d-bb48-9935e725fe82)


## Contraintes et Exigences

- **Conception Centrée sur l'Utilisateur** : L'interface doit se concentrer sur les besoins des utilisateurs, avec une bonne ergonomie et expérience utilisateur.
- **Exigences Fonctionnelles et Techniques** :
  - Persistance des données via une base de données MySQL ou SQL Server.
  - Application entièrement paramétrable (pas de valeurs en dur dans le code) via une page de préférences (adresse de la base de données, étiquettes des champs texte, boutons, etc.).


- Compte utilisateur (test) :
		- Adresse mail : ewen.buhot@gmail.com
		- Mot de passe : Buhot123

   - Compte producteur (test) :
		- Adresse mail : arkan.catalon@laposte.net
		- Mot de passe : Arkan123
 - Identifiant administrateur : or.noir@gmail.com 
   - Mot de passe administrateur : root
