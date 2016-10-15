<?php
    // If the user is connected, this page should redirect to the home page.
    $errorMessage = "";
    if (isset($_SESSION["username"]))
        header('Location: ../index.php');
    if (isset($_POST["email"]))
        include_once("register_user.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - S'enregistrer</title>
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

        </div>

        <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../static/js/materialize.min.js"></script>
        <script src="../static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
