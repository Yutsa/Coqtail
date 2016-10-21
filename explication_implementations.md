Explication des choix d'implémentations
----------------------------------------

Processus d'inscription
=======================

### Formulaire

Lorsqu'un utilisateur tente de s'inscrire et que l'email choisi
est déjà utilisé, il est alors redirigé sur la page du
formulaire avec une indication expliquant que l'email est déjà
utilisé.

Cependant le champ email est remis à zéro. Cela est un choix
car il ne servirait à rien de laisser l'adresse mail déjà
utilisée dans le champ.

### Mode de stockage

Nous avons choisi de stocker les informations dans des fichiers
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

### Inclusion du menu

Nous avons rencontré des difficultés lors de l'inclusion du
mot de passe. En effet nous utilisions des liens relatifs,
cependant la page n'était pas au même niveau hiérarchique
dans le dossier. Par exemple l'index est à la racine mais les
pages comme le formulaire de connexion ou d'inscription sont
dans un sous dossier.

C'est pourquoi nous utilisons un `define` pour définir la
racine du projet. Nous construisons ensuite les liens grâce à
cette racine.
