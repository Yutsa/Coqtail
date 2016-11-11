<?php
//session_start();
include_once("core/basket.inc.php");

createCookieBasket();
include_once("core/donnees.inc.php");
include_once("core/functions.inc.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'tail</title>

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="static/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include_once("templates/favicon.inc.php"); ?>
    </head>

    <body>
        <?php include_once("templates/menu.inc.php"); ?>
        <main class="container">
            <div class="row">
                <h1 class="col s12 center">Bienvenue sur Coq'tail le site de recettes de cocktail</h1>
            </div>
            <div class="row">
                <div class="col s4">
                    <h3 class="center">Parcour par ingrédients</h3>
                    <p>
                        Coq'tail vous permet de parcourir des recettes de
                        cocktails par ingrédients.
                    </p>
                </div>
                <div class="col s4">
                    <h3 class="center">Enregistrez vos cocktails préférés</h3>
                    <p>
                        Grâce au système de panier vous ne perdrez plus
                        jamais vos recettes de cocktails préférés.
                    </p>
                </div>
                <div class="col s4">
                    <h3 class="center">Recherche avancée de cocktail</h3>
                    <p>
                        Grâce à la barre de recherche vous pouvez trouver
                        plus précisemment le cocktail que vous cherchez en
                        ajoutant et excluant des ingrédients !
                    </p>
                </div>
            </div>
        </main>


        <script type="text/javascript" src="static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="static/js/materialize.min.js"></script>
        <script src="static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
