---
title:  Rapport Projet de Web
author: Thibert LETULLIER, Nicolas MARTIN et Édouard WILLISSECK
geometry: margin=3cm
---

Rapport projet Web
----------------------------------------

Installation du site
=====================

Coller le dossier `Projet` dans EasyPHP.


Processus d'inscription
=======================

### Formulaire

Lorsqu'un utilisateur tente de s'inscrire et que l'email choisi
est déjà utilisée, il est alors redirigé sur la page du
formulaire avec une indication expliquant que l'email est déjà
utilisé.

Les deux seuls champs obligatoires sont l'email et le mot de passe.
Tous les champs sont testés avec des regex pour s'assurer de leurs
validité.
Ils sont bien entendu tous remplis automatiquement à nouveau si la
saisie est fausse.

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
sérialisé représentant l'adresse mail, le mot de passe crypté et toutes les
informations liées au profil ainsi qu'un tableau représentant le panier de cet
utilisateur.

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

L'ajout et le retrait d'une recette au panier se fait par un bouton sur la
recette.

Ce bouton affiche "Ajouter" lorsque l'article n'est pas encore dans le panier,
et "Supprimer" lorsqu'il est déjà dans le panier.

Lorsque l'utilisateur clique sur le bouton, une requête AJAX est envoyée pour
ajouter l'article au panier. Le bouton change également d'état pour passer
de "Ajouter" à "Supprimer" ou inversement.

L'utilisation d'AJAX pour l'ajout au panier, et de JavaScript en général pour
changer l'apparence du bouton permet la manipulation du panier sans avoir besoin
de recharger la page, ce qui nuirait à l'UX (expérience utilisateur).

Parcours d'ingrédients
======================

La page se présente sous la forme d'un menu présentant toutes
les sous-catégories de la catégorie principale (ici Aliment) d'un côté, et de
l'autre l'affichage des recettes contenant l'ingrédient
(ou une de ses sous catégorie) correspondant(es).

C'est un menu déroulant qui est utilisé. Lorsqu'un clic est détecté, le catégorie
affiche alors toutes ses sous-catégories directes en dessous d'elle tout en
laissant visible les autres super-catégories. Les sous-catégories affichées sont
aussi un menu déroulant, ce qui permet de recommencer jusqu'à arriver à la
catégorie la plus basse (sans sous catégorie). Une marge ainsi qu'une couleur
sont utilisées pour permettre à l'utilisateur d'avoir une bonne lisibilité dans
le menu.

Le menu est généré dynamiquement. Au début, seule les première sous catégorie
sont affichées. C'est en cliquant sur un ingrédients que ses sous-catégories
seront chargée, grâce à une requête ajax, puis que le menu créé sera inseré à
l'endroit souhaité. L'affichage se fait bien entendu en temps réèl.

Plusieurs difficultés ont été rencontrées lors de la création de ce menu.

La première, et sûrement la plus importante, était qu'il nous était impossible
de récupérer le clic sur un menu qui avait été générer dynamiquement. Malgré des
recherches et de nombreux test, il était pas possible de détecter le clic sur un
sous-menu généré. La solution était pourtant très simple :

Le code pour détecter le clic était le suivant :
`$('div.collapsible-header').onclick(function() {...});`
Alors que pour que ça marche avec des éléments dynamiques il fallait l'écrire
avec cette syntaxe :
`$('body').on('click', 'div.collapsible-header', function() {...});`

L'ajax nous à posé quelques soucis au début mais à rapidement été pris en main
et donc n'a pas été une difficulté lourde.

La recherche d'ingrédients
===========================

Sur la page de recherche vous pouvez taper dans une barre de recherche les
ingrédients que vous souhaitez ou non, des propositions sont affichées si
le ou les ingrédients existent. Il suffit de cliquer dessus pour le sélectionner.

Une fois vos ingrédients séléctionnés vous pouvez cliquer sur ceux que vous ne
souhaitez pas pour les exclure de la recherche.

L'initialisation de l'autocomplétion était une des phases les plus longues de
cette étapes. Il faut d'abord récupérer un tableau avec tous les ingrédients,
qu'il faut ensuite traduire de php à JavaScript. Il faut ensuite gérer les
suggestions qui doivent apparaîtres, et en extraire le contenues quand elle sont
séléctionnées.

Du côté php c'est la recherche approximative qui a été plus longue. En plus de
rechercher les éléments qui correspondait, il fallait aussi tester, si aucune
recette n'était affichée, de rechercher des recettes qui ne correspondait pas à
1 élements près.

Profil de l'utilisateur
========================

Une page est dédié au profil de l'utilisateur. Cette page contient toutes les
informations de l'utilisateur hors mot de passe et permet la modification de
toutes ces informations hors adresse mail.

Fonctionnement du site
=======================

Le site est composée de plusieurs pages toutes accessibles par une barre de
navigation. Elle est dynamique, ce qui signifie que seules les pages utiles
sont affichées (pas de page connexion quand l'utilisateur l'est déjà).
Pour revenir à la page d'accueil, il suffit de cliquer sur "Coq'tail" en
haut à gauche.
