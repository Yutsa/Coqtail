<?php
//session_start();
include_once(realpath(dirname(__FILE__) .
                      "/../core/functions_ingredient_menu.inc.php"));
include_once(realpath(dirname(__FILE__) .
                      "/../core/donnees.inc.php"));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - Rechercher un cocktail</title>
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

        <div class="row center">
            <div class="input-field col s12">
                <p>Ajouter un ingrédient à la recherche</p>
                <input type="text" id="autocompleteState" class="autocomplete inputFields center">
            </div>
            <div class="col s12">
                <ul id="list">
                    
                </ul>
            </div>
            <div class="col s12 card-panel blue lighten-5">
                    <p>Cliquez sur un élément pour l'exclure de la recherche. Cliquez sur la croix pour le supprimer.</p>
            </div>
            <div class="col s12" id="displaySearch">
                
            </div>
        </div>

       
        <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../static/js/materialize.min.js"></script>
        <script type="text/javascript" src="../static/js/jquery.bind-first-0.2.2.min.js"></script>       
        <script src="../static/js/custom.js" charset="utf-8"></script>
        <script type="text/javascript" src="../static/js/search.js"></script>
        <script type="text/javascript" src="../bower_components/materialize-autocomplete/jquery.materialize-autocomplete.min.js"></script>
        

    </body>
</html>
