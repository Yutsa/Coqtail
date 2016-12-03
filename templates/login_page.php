<?php
include_once("../core/basket.inc.php");
    // If the user is connected, this page should redirect to the home page.
    $errorMessage = "";
    if (isset($_SESSION["username"]))
        header('Location: ../index.php');
    if (isset($_POST["email"]))
        include_once("../core/connect_user.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - Se connecter</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../static/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include_once('favicon.inc.php'); ?>
    </head>
    <body>
        <?php include_once 'menu.inc.php' ?>

        <div class="container">
            <div class="row">
                <h1>Se connecter</h1>
            </div>
            <div class="row">
                <form class="col s12" action="#" method="post">
                    <div class="input-field col s6">
                        <input id="email" name="email" type="email" class="validate" required>
                        <label for="email">Email</label>
                        <?= $errorMessage ?>
                    </div>
                    <div class="input-field col s6">
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Mot de passe</label>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light col s4 offset-s4 " type="submit" name="action">
                            Se connecter<i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../static/js/materialize.min.js"></script>
        <script src="../static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
