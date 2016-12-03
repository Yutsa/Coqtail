<?php
include_once("functions.inc.php");
include_once("donnees.inc.php");
define("indexFilePath", "../data/accounts_index");
session_start();

if (!isset($_SESSION["notConnectedBasket"]))
{
    $_SESSION["notConnectedBasket"] = array();
}

/**
  * Returns the basket of the current user
  * @return basket of the user
  **/
function getUserBasket()
{
    if(isConnected())
    {
        $userDataFileName = $_SESSION["userDataFileName"];
        $userDataFilePath = $userDataFileName;
        $userDataFile = fopen($userDataFilePath, "r");
        $userData = unserialize(fgets($userDataFile));
        fclose($userDataFile);
        return $userData["basket"];
    }
    else
    {
        return $_SESSION["notConnectedBasket"];
    }
}

/**
  * Merges the not connected basket with the connected basket
  **/
function basketFusion(){
    $userDataFileName = $_SESSION["userDataFileName"];
    $userDataFilePath = $userDataFileName;
    $userDataFile = fopen($userDataFilePath, "r+");
    $userData = unserialize(fgets($userDataFile));
    fclose($userDataFile);
    $userBasketConnected = $userData["basket"];

    $userBasketNotConnected = $_SESSION["notConnectedBasket"];
    foreach ($userBasketNotConnected as $recipe) {
        if(!in_array($recipe,$userBasketConnected)){
            $userData["basket"][]=$recipe;
        }
    }
    $userDataFile = fopen($userDataFilePath, "w+");
    fwrite($userDataFile, serialize($userData));
    fclose($userDataFile);
    unset($_SESSION["notConnectedBasket"]);
}

/**
  * Adds the recipe to the user's basket.
  * @param $recipe The recipe to add to the basket.
  **/
function addRecipeBasket($recipe)
{
    if(isConnected())
    {
        $userDataFileName = $_SESSION["userDataFileName"];
        $userDataFilePath = $userDataFileName;
        $userDataFile = fopen($userDataFilePath, "r+");
        $userData = unserialize(fgets($userDataFile));
        $userData["basket"][] = $recipe;
        fclose($userDataFile);
        $userDataFile = fopen($userDataFilePath, "w+");
        fwrite($userDataFile, serialize($userData));
        fclose($userDataFile);
    }
    else
    {
        $_SESSION["notConnectedBasket"][] = $recipe;
    }
}


//TODO: Search usage of this function since the return type changed.
/**
  * Searches a recipe in the user's basket
  * @param $recipe The recipe to search
  * @return The index of recipe in the basket or FALSE if it doesn't exist
  **/
function searchRecipeInBasket($recipe){
    if(isConnected())
    {
        $userDataFileName = $_SESSION["userDataFileName"];
        $userDataFilePath = "../data/" . $userDataFileName;
        $userDataFile = fopen($userDataFilePath, "r");
        $userData = unserialize(fgets($userDataFile));
        fclose($userDataFile);
        return array_search($recipe, $userData["basket"]);

    }
    else
    {
        return array_search($recipe, $_SESSION["notConnectedBasket"]);
    }
}

/**
  * Removes a recipe in the user's basket
  * @param $recipe The recipe to remove
  **/
function removeRecipeFromBasket($recipe){

    if(($index = searchRecipeInBasket($recipe))!=-1){
        if(isConnected())
        {
            $userDataFileName = $_SESSION["userDataFileName"];
            $userDataFilePath = "../data/" . $userDataFileName;
            $userDataFile = fopen($userDataFilePath, "r");
            $userData = unserialize(fgets($userDataFile));
            unset($userData["basket"][array_search($recipe, $userData["basket"])]);
            fclose($userDataFile);
            $userDataFile = fopen($userDataFilePath, "w+");
            fwrite($userDataFile, serialize($userData));
            fclose($userDataFile);
        }
        else
        {
            $index = array_search($recipe,
                $_SESSION["notConnectedBasket"]);
            unset($_SESSION["notConnectedBasket"][$index]);
        }
    }
}

/**
  * Checks if the user is logged in or not.
  * @return true if user logged false otherwise
  **/
function isConnected()
{
    return isset($_SESSION["userDataFileName"]);
}

/**
  * Display all the recipes of the user's basket logged or not
  **/
function displayBasket(){
    $userBasket = getUserBasket();
    $i = 0;
    foreach ($userBasket as $recipe) {
        if ($i % 4 === 0)
            echo ('<div class="row">');

        // Display the recette
        displayCocktail($recipe);


        // End of the div 'row'
        if ($i % 4 === 3)
            echo ("</div>");

        $i++;
    }
}

/*
* This script is executed by the Ajax call when a cocktail is to be added or
* removed from the user's basket.
*/
if (isset($_POST["titre"]))
{
    $recipe = getCocktailByName($_POST["titre"], $Recettes);
    if ($_POST["action"] == "add")
    {
        addRecipeBasket($recipe);
        echo "add";
    }
    else if ($_POST["action"] == "remove")
    {
        removeRecipeFromBasket($recipe);
        echo "remove";
    }
}

?>
