<?php
//session_start();
include_once("../config/config.inc.php");
include_once(realpath(dirname(__FILE__) .
                      "/../core/functions_ingredient_menu.inc.php"));
include_once(realpath(dirname(__FILE__) .
                      "/../core/donnees.inc.php"));
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - Rechercher un cocktail</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Ne fonctionnera pas si le projet n'est pas dans le dossier
"Projet" sur les ordinateurs de la fac. -->
        <link href="<?php ROOT_URI . "/static/css/style.css"?>" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../static/css/materialize.min.css"  media="screen,projection"/>


        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include_once 'favicon.inc.php'; ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>jQuery UI Autocomplete - Default functionality</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="../static/js/search.js"></script>
        <script type="text/javascript" src="../static/js/jquery.bind-first-0.2.2.min.js"></script>

    </head>
    <body>
        <?php include_once 'menu.inc.php' ?>

        <div class="row center container">
            <div class="input-field col s12">
                <h2 class="col s12 center">Recherchez un ingrédient : </h2>
                <div class="ui-widget">
                    <input id="tags">
                </div>
            </div>
            <div class="col s12">
                <ul id="list">

                </ul>
            </div>

            <div class="col s12" id="displaySearch">

            </div>
        </div>
    </body>

    <script type="text/javascript" src="../config/config.js"></script>
    <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
<!--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="../static/js/materialize.min.js"></script>
    <script src="../static/js/custom.js" charset="utf-8"></script>
    <script type="text/javascript" src="../bower_components/materialize-autocomplete/jquery.materialize-autocomplete.min.js"></script>
</html>
