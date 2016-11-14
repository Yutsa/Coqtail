<?php
//session_start();
include_once(realpath(dirname(__FILE__) .
                      "/../core/functions_ingredient_menu.inc.php"));
include_once(realpath(dirname(__FILE__) .
                      "/../core/donnees.inc.php"));
include_once("../core/basket.inc.php");
createCookieBasket();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - Choisissez un cocktail</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Ne fonctionnera pas si le projet n'est pas dans le dossier
"Projet" sur les ordinateurs de la fac. -->
        <link href="/Projet/static/css/style.css" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../static/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include_once 'favicon.inc.php'; ?>
    </head>
    <body>
        <?php include_once 'menu.inc.php' ?>

        <div class="row">
            <!-- Menu -->
            <div class="menu col s3 m3 l3">
                <?php
                displayMenuItem('Aliment', $Hierarchie);
                ?>
            </div>
            <!-- Recettes -->
            <div class="col s9 m9 l9">
                <div id="recette" class="card-panel row center">
                    <h5>Choisissez vos ingrédients parmis ceux proposés dans le menu, et effectuez une recette de plus en plus précise. Les recettes correspondantes seront affichée ici.</h5>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../static/js/materialize.min.js"></script>
        <script src="../static/js/custom.js" charset="utf-8"></script>
        <script type="text/javascript" src="../bower_components/materialize-autocomplete/jquery.materialize-autocomplete.min.js"></script>
        
    </body>
</html>
