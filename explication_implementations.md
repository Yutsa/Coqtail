---
title:  Rapport Projet de Synthèse
author: Thibert LETULLIER, Nicolas MARTIN et Édouard WILLISSECK
geometry: margin=3cm
---

Rapport projet Web
----------------------------------------

Processus d'inscription
=======================

### Formulaire

Lorsqu'un utilisateur tente de s'inscrire et que l'email choisi
est déjà utilisée, il est alors redirigé sur la page du
formulaire avec une indication expliquant que l'email est déjà
utilisé.

Cependant le champ email est remis à zéro. Cela est un choix
car il ne servirait à rien de laisser l'adresse mail déjà
utilisée dans le champ.

### Mode de stockage

Nous avons choisi de stocker les informations (panier) dans des fichiers
texte. Cela permet d'éviter l'utilisation d'une base de donnée
et donc de faciliter le déploiement du site web sur de nouveaux
serveurs par exemple.

On utilise un premier fichier qui sert d'index ayant la
structure suivante :

`adresse_mail:chemin_vers_fichier_données_utilisateur`

Il suffit donc de parcourir ce fichier index pour trouver un
utilisateur grâce à son adresse mail pour obtenir le chemin
vers le fichier de données de cet utilisateur.

À l'intérieur du fichier de données se trouve un tableau
sérialisé représentant l'adresse mail, le mot de passe crypté ainsi qu'un tableau représentant le panier de cet utilisateur.

Nous aurions pu également simplement stocker du code php dans un
fichier avec la variable correspondant à l'utilisateur. Cependant
cette façon de faire est moins souple.

Inclusion du menu
=================

Nous avons rencontré des difficultés lors de l'inclusion du
menu. En effet nous utilisions des liens relatifs,
cependant la page n'était pas au même niveau hiérarchique
dans le dossier. Par exemple l'index est à la racine mais les
pages comme le formulaire de connexion ou d'inscription sont
dans un sous dossier.

C'est pourquoi nous utilisons un `define` pour définir la
racine du projet. Nous construisons ensuite les liens grâce à
cette racine.

Test Unitaires
==============

Nous avons décidé d'utiliser PHPUnit pour effectuer des tests unitaires
et s'assurer de la validité de nos fonctions. Cela permet également de
vérifier que tout fonctionne toujours après un changement
d'implémentation d'un composant du site par exemple.

Taille cookies
===============

On ne peut mettre que 5 à 6 recettes dans son panier sans être connecter à
cause de la taille maximum des cookies.

Cela est dû au fait que l'on stock l'array représentant une recette que l'on
sérialise. Cela prend donc beaucoup de place.

Cependant le fait d'être limité en étant non connecté pousse l'utilisateur à
s'inscrire ce qui peut être positif.

C'est pourquoi nous avons décidé de laisser cela comme ça. Nous aurions également pu utiliser des variables de sessions pour éviter cela.

Ajout/Retrait de recettes du panier
====================================

L'ajout et le retrait d'une recette au panier se fait par un bouton sur la recette.

Ce bouton affiche "Ajouter" lorsque l'article n'est pas encore dans le panier,
et "Supprimer" lorsqu'il est déjà dans le panier.

Lorsque l'utilisateur clique sur le bouton, une requête AJAX est envoyée pour ajouter l'article au panier. Le bouton change également d'état pour passer
de "Ajouter" à "Supprimer" ou inversement.

L'utilisation d'AJAX pour l'ajout au panier, et de JavaScript en général pour
changer l'apparence du bouton permet la manipulation du panier sans avoir besoin de recharger la page, ce qui nuirait à l'UX (expérience utilisateur).

Gestion de panier qui déconne sous Safari
==========================================

La gestion du panier a des problèmes lorsqu'on utilise le navigateur Safari mais nous n'avons pas réussi à en trouver la cause.
