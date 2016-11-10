<?php
  include_once("functions.inc.php");
  include_once("donnees.inc.php");
  define("indexFilePath", "../data/accounts_index");
  session_start();
  /**
  * return the basket of the current user
  * @return basket of the user
  **/
  function getUserBasket()
  {
    if(isConnected()){
      $userDataFileName = $_SESSION["userDataFileName"];
      $userDataFilePath = $userDataFileName;
      $userDataFile = fopen($userDataFilePath, "r");
      $userData = unserialize(fgets($userDataFile));
      fclose($userDataFile);
      return $userData["basket"];
    }
    else {
      return unserialize($_COOKIE["userBasket"]);
    }
  }

  /**
  * Merges the cookie basket with the connected basket
  **/
  function basketFusion(){
    $userDataFileName = $_SESSION["userDataFileName"];
    $userDataFilePath = $userDataFileName;
    $userDataFile = fopen($userDataFilePath, "r+");
    $userData = unserialize(fgets($userDataFile));
    fclose($userDataFile);
    $userBasketConnected = $userData["basket"];
    $userBasketCookie = unserialize($_COOKIE["userBasket"]);
    foreach ($userBasketCookie as $recipe) {
      if(!in_array($recipe,$userBasketConnected)){
        $userData["basket"][]=$recipe;
      }
    }
    $userDataFile = fopen($userDataFilePath, "w+");
    fwrite($userDataFile, serialize($userData));
    fclose($userDataFile);

  }

  /**
  * Create the cookie that contains the basket of the user not logged
  **/
  function createCookieBasket()
  {
    if(!isset($_COOKIE["userBasket"])){
      $userBasket = array();
      setcookie("userBasket",serialize($userBasket), time()+60*60*25*30, "/Projet");
    }
  }

  /**
  * Add to the user's basket a new recipe
  **/
  function addRecipeBasket($recipe){
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
    else {
      $userBasket = unserialize($_COOKIE["userBasket"]);
      $userBasket[] = $recipe;
      setcookie("userBasket",serialize($userBasket), time()+60*60*25*30, "/Projet");
    }
  }

  /**
  * Search a recipe in the user basket
  * @return the index of recipe in the basket or -1 if is don't exist
  * @param $recipe the recipe to search
  **/
  function searchRecipeInBasket($recipe){
    $index = 0;
    if(isConnected()){
      $userDataFileName = $_SESSION["userDataFileName"];
      $userDataFilePath = "../data/" . $userDataFileName;
      $userDataFile = fopen($userDataFilePath, "r");
      $userData = unserialize(fgets($userDataFile));
      foreach($userData["basket"] as $userRecipe){
        if($userRecipe == $recipe){
          return $index;
        }
        $index++;
      }
      fclose($userDataFile);
    }
    else{
      $userBasket = unserialize($_COOKIE["userBasket"]);
      foreach($userBasket as $userRecipe){
        if($userRecipe == $recipe){
          return $index;
        }
        $index++;
      }
    }
    return -1;
  }

  /**
  * Remove a recipe in the user's basket
  * @param $recipe the recipe to remove
  **/
  function removeRecipeFromBasket($recipe){

    if(($index = searchRecipeInBasket($recipe))!=-1){
      if(isConnected()){
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
      else{
        $userBasket = unserialize($_COOKIE["userBasket"]);
        unset($userBasket[array_search($recipe, $userBasket)]);
        setcookie("userBasket",serialize($userBasket), time()+60*60*25*30, "/Projet");
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
