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

Taille cookies et panier non connecté
======================================

Au départ nous utilisions un cookie pour stocker la panier d'un
utilisateur non connecté. Cependant les cookies ont une taille limite.
Comme nous avons fait le choix de stocker les recettes en stockant
directement le tableau représentant la recette, cela prend de la place.

Ce problème de taille limitait à 6 recettes dans le cookie. Pour ne
plus avoir ce problème deux solutions étaient possibles. Stocker
seulement le nom de la recette ou bien utiliser une variable de session.

Nous avons décidé de stocker le tableau représentant une recette car
cela nous permet de gagner du temps lors des recherches de présence de
recette par exemple.

C'est pourquoi nous avons opté pour l'utilisation d'une variable de
session pour le panier d'un utilisateur non connecté.

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
