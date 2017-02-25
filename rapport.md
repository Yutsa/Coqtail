# Rapport du projet

## Parcours d'ingredients

Le deuxième onglet de site, après la page d'acueil est consacré à la recherche d'ingrédients. La page se présente sous la forme d'un menu présentant toutes les sous-catégories de la catégorie principale (ici Aliment) d'un côté, et de l'autre l'affichage des recettes contenant l'ingredient (ou une de ses sous catégorie) correspondant(e). 

C'est un menu déroulant qui est utilisé. Lorqu'un clic est détecté, le catégorie affiche alors toutes ses sous-catégories directes en dessous d'elle tout en laissant visible les autres super-catégories. Les sous-catégories affichées sont aussi un menu déroulant, ce qui permet de recommencer jusqu'à arriver à la catégorie la plus basse (sans sous catégorie). Une marge ainsi qu'une couleur sont utilisées pour permettre à l'utilisateur d'avoir une bonne lisibilité dans le menu. 

Le menu est généré dynamiquement. Au debut, seule les première sous catégorie sont affichées. C'est en cliquant sur un ingredients que ses sous-categories seront chargée, grâce à une requête ajax, puis que le menu créé sera inseré à l'endroit souhaité. L'affichage se fait bien entendu en temps réèl.

Plusieurs difficultés ont été rencontrées lors de la création de ce menu.

La première, et sûrement la plus importante, était qu'il nous était impossible de récupérer le clic sur un menu qui avait été générer dynamiquement. Malgré des recherches et de nombreux test, il était pas possible de détecter le clic sur un sous-menu généré. La solution était pourtant très simple :
Le code pour détecter le clic était le suivant : 
`$('div.collapsible-header').onclick(function() {...});`
Alors que pour que ça marche avec des éléments dynamiques il fallait l'écrire avec cette syntaxe :
`$('body').on('click', 'div.collapsible-header', function() {...});`

L'ajax nous à posé quelques soucis au début mais à rapidement été pris en main et donc n'a pas été une difficulté lourde.


## La recherche d'ingredients

Le troisième onglet est consacré à la recherche textuelle d'une recette. En commencant à taper un mot vous aurez le choix avec tout les ingredients qui commencent par la recherche. Il siffot alors de cliquer dessus pour l'ajouter à la recherche. L'ingrédient voulu est affiché et on peut rechercher un nouvel ingredient. Sur les ingédients affiché, il est possible de cliquer dessus pour l'exclure de la recherche ou bien de l'enlever.

L'initialisation de l'autocomplétion était une des phases les plus longues de cette étapes. Il faut d'abord récuperer un tableau avec tous les ingrédients, qu'il faut ensuite traduire de php à javaScript. Il faut ensuite gérer les suggestions qui doivent apparaitres, et en extraire le contenues quand elle sont séléctionnées.

Du côté php c'est la recherche approximative qui a été plus longue. En plus de rechercher les éléments qui correspondait, il fallait aussi tester, si aucune recette n'était affichée, de rechercher des recettes qui ne correspondait pas à 1 élements près.