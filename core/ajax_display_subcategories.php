<?php
/*
    Ajax call endpoint to display the subcategories
    of the clicked category in the menu.
*/

include_once("functions_ingredient_menu.inc.php");
include_once("donnees.inc.php");

displayMenuItem($_POST['cat'], $Hierarchie);
?>
