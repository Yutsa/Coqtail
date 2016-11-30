<?php
// Ajax file call in custom.js

// This file will return recite with ingredient give in Post
// and without other ingredient give in post too
// Call by the javascript file custom.js
include_once("functions.inc.php");
include_once("donnees.inc.php");

//Take recite and un ingredient
//Search if the ingredient and all of its subcategories
//are in the recite.
//Return true if ingredient is in recite, false otherwise
function isWithIngredient(&$Hierarchie, $searchIngredient, $recette)
{
    //Get all subcategories in an array
    $ingredientsArray = array();
    getAllSubcategories($searchIngredient, $Hierarchie, $ingredientsArray);

    //Iterates through each ingredients (give in param and subcat)
    foreach ($ingredientsArray as $ingredient)
    {
        //Iterates through every ingredient in teh recite
        foreach ($recette['index'] as $reciteIngredient)
        {
            //If ingredient found, return true
            if ($reciteIngredient == $ingredient)
            {
                return true;
            }
        }
    }
    //If ingredient don't found, return false
    return false;
}

$atLeastOneRecite = false;
$suggestRecite = array();

//Iterates through each recites
foreach($Recettes as $recette)
{
    //Booleans for with and without
    $okWith = 0;
    $okWithout = 0;

    $nbWith = 0;
    $nbWithout = 0;

    //Check if there are ingredient to have
    if (isset($_POST['addElement']))
    {
        //Count number of ingredient to have
        $nbWith = count($_POST['addElement']);

        //Each element in the search
        foreach($_POST['addElement'] as $withIngredient)
        {
            //Incremente for each addElement if it match
            if (isWithIngredient($Hierarchie, $withIngredient, $recette))
            {
                $okWith++;
            }
        }
    }

    //Check if there are ingredient to not have
    if(isset($_POST['removeElement']))
    {
        //Count number of ingredient to not have
        $nbWithout = count($_POST['removeElement']);

        //Each element in the search
        foreach($_POST['removeElement'] as $withIngredient)
        {
            //Incremente for each addElement if it don't match
            if (!isWithIngredient($Hierarchie, $withIngredient, $recette))
            {
                $okWithout++;
            }
        }
    }

    //If there are at least one ingredient to search
    if ($nbWithout > 0 || $nbWith > 0)
    {
        //If there are all ingredient need and all ingredient don't need
        if ($okWith == $nbWith 
            && $okWithout == $nbWithout)
        {
            //Display recites matchs
            displayCocktail($recette);
            $atLeastOneRecite = true;
        }
        //Else, try with a recite with 1 ingredient doesn't match
        else if ($okWith == $nbWith-1)
        {
            $suggestRecite[] = $recette;
        }
    }
}

//If there are no recite display (no match)
if (!$atLeastOneRecite && ($nbWithout > 0 || $nbWith > 0))
{
    //If there is at least one approximative recite, display it
    if (count($suggestRecite) > 0)
    {
        echo ("<p class='red'>Aucune recette n'existe avec ces ingredients, voici des recettes dont le résultat est proche :");
        foreach($suggestRecite as $recite)
        {
            displayCocktail($recite);
        }
    }
    //If there is no recite, display an error message
    else 
    {
        echo ("<p class='red'>Aucunes recette n'existe avec ces ingredients, ni aucunes recherche approximative");
    }
}
?>