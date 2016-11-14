<?php
// Ajax file call in custom.js

// This file will return all donnees's ingredients
// call by the javascript file custom.js
include_once("functions.inc.php");
include_once("donnees.inc.php");

$allSubCat = array();

getAllSubcategories('Aliment', $Hierarchie, $allSubCat);

foreach($allSubCat as $nameCat)
{
    echo($nameCat . ':');
}

?>