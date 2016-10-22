<?php
  define($indexFilePath, "../data/accounts_index");

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
      /**
      * TODO : Add in file the new basket
      **/
      fclose($userDataFilePath);
    }
    else {
      $userBasket = unserialize($_COOKIE["userBasket"]);
      $userBasket[] = $recipe;
      setcookie("userBasket",serialize($userBasket), time()+60*60*25*30)
    }
  }

  /**
  * Test if a user is logged
  * @return true if user logged false otherwise
  **/
  function isConnected()
  {
    if(isset($_SESSION["dataFileName"])){
      return true;
    }
    else {
      return false;
    }
  }


 ?>
