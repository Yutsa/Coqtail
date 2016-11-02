<?php
// Ajax file call in custom.js

// This file will return display of recettes wich are selected
// by the javascript file
include_once("functions.inc.php");
include_once("donnees.inc.php");

//Get all recette with ingredient selected 
$recettes = getAllCocktailsWithIngredient($_POST['cat'], $Hierarchie, $Recettes);

$i = 0;

// For all recettes
foreach($recettes as $recette)
{
    // Put a div 'row' each 4 div 'recette' for an optimal display
    if ($i % 4 === 0) 
        echo ('<div class="row">');
    
    // Display the recette
    displayCocktail($recette);

    // End of the div 'row'
    if ($i % 4 === 3)
        echo ("</div>");
    
    $i++;
}

?>