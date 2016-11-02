<?php
  include_once("functions.inc.php");
  include_once("donnees.inc.php");
  define("indexFilePath", "../data/accounts_index");
  /**
  * return the basket of the current user
  * @return basket of the user
  **/
  function getUserBasket()
  {
    if(isConnected()){
      $userDataFileName = $_SESSION["userDataFileName"];
      $userDataFilePath = "../data/" . $userDataFileName;
      $userDataFile = fopen($userDataFilePath, "r");
      $userData = unserialize(fgets($userDataFile));
      fclose($userDataFilePath);
      return $userData["basket"];
    }
    else {
      return unserialize($_COOKIE["userBasket"]);
    }
  }

  /**
  * Create the cookie that contains the basket of the user not logged
  **/
  function createCookieBasket()
  {
    $userBasket = array();
    setcookie("userBasket",serialize($userBasket), time()+60*60*25*30);
  }

  /**
  * Add to the user's basket a new recipe
  **/
  function addRecipeBasket($recipe){
    if(isConnected())
    {
      $userDataFileName = $_SESSION["userDataFileName"];
      $userDataFilePath = "../data/" . $userDataFileName;
      $userDataFile = fopen($userDataFilePath, "r");
      $userData = unserialize(fgets($userDataFile));
      $userData["basket"][] = $recipe;
      fclose($userDataFilePath);
      $userDataFile = fopen($userDataFilePath, "w");
      fwrite($userDataFile, serialize($userData));
      fclose($userDataFilePath);
    }
    else {
      $userBasket = unserialize($_COOKIE["userBasket"]);
      $userBasket[] = $recipe;
      setcookie("userBasket",serialize($userBasket), time()+60*60*25*30);
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
    echo 'Test1';
    if(isConnected()){
      echo 'Test2';
      foreach ($userBasket as $recipe) {
        echo 'Test2.1';
        displayCocktail($recipe);
      }
    }
    else{
      echo 'Test3';
      foreach ($userBasket as $recipe) {
        echo 'Test3.1';
        displayCocktail($recipe);
      }
    }
  }

if (isset($_POST["titre"]))
{
    $recipe = getCocktailByName($_POST["titre"], $Recettes);
    echo ($_POST["titre"]);
    //addRecipeBasket($recipe);
}

 ?>
