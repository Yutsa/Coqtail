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
            <div class="row">
                <h1 class="col s12">Bienvenue sur Coq'tail le site de recettes de cocktail</h1>
            </div>
            <div class="row">
                <p class="col s12">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </main>


        <script type="text/javascript" src="static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="static/js/materialize.min.js"></script>
        <script src="static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
