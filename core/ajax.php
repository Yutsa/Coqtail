<?php
// File call in custom.js

//include_once("functions.inc.php");
include_once("functions_ingredient_menu.inc.php");
include_once("donnees.inc.php");

displayMenuItem($_POST['cat'], $Hierarchie);
?>
