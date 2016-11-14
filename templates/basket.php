<?php
  //session_start();
  include_once("../core/basket.inc.php");
  createCookieBasket();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - Panier</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../static/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../static/css/style.css" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include_once 'favicon.inc.php'; ?>
    </head>
    <body>
        <?php include_once 'menu.inc.php' ?>
        <h1 class="center">Votre panier : </h1>
          <?php
          displayBasket();
          ?>

    <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="../static/js/materialize.min.js"></script>
    <script src="../static/js/custom.js" charset="utf-8"></script>
    <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
