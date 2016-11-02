<?php
session_start();
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

            <?php
            /* Example of how to display cocktails from an ingredient. */
            $recettes = getAllCocktailsWithIngredient("Liqueur", $Hierarchie, $Recettes);
            foreach($recettes as $recette)
            {
                displayCocktail($recette);
            }
            ?>
        </main>


        <script type="text/javascript" src="static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="static/js/materialize.min.js"></script>
        <script src="static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
