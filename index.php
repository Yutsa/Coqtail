<?php 
include_once("examples/cocktail_card.php"); 
include_once("core/favicon.inc.php"); 
include_once("core/donnees.inc.php"); 
include_once("core/functions.inc.php"); 
include_once("core/menu.inc.php"); 
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
</head>
<body>

    <?php

    
    $KeysHierarchie = array_keys($Hierarchie);
    $i = -1;
    foreach ($Hierarchie as $Aliment) {
        $i ++;
        if (!array_key_exists('super-categorie', $Aliment)) {
            $Racine = $KeysHierarchie[$i];
            echo('-> ' . $KeysHierarchie[$i]. '<br />');
        }
    }
    
    Insert($Hierarchie);
    
//    foreach ($Hierarchie[$Racine] as $SousCategories) {
//        foreach ($SousCategories as $SousCategorie) {
//            echo('L__ ' . $SousCategorie . '<br />');
//        }
//    }
    
//    $SousCategories = GetSousCategories($Hierarchie, $Racine);
//        foreach ($SousCategories as $SousCategorie) {
//            echo('L__ ' . $SousCategorie . '<br />');
//        }
    
    ?>

    <main class="container">
        <?php displayCocktail("Test de fou", "Description troll",
        "static/img/Black_velvet.jpg"); ?>
        <?php displayCocktail("Black Velvet", "Le black velvet, miam",
        "static/img/Black_velvet.jpg"); ?>
    </main>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="static/js/materialize.min.js"></script>
    <script src="static/js/custom.js" charset="utf-8"></script>
</body>
</html>
