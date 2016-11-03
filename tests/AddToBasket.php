<?php

use PHPUnit\Framework\TestCase;


class BasketTest extends TestCase
{

    private $mail = "robertrobert@gmail.com";
    private $pwd = "pwdd";

    public function testGetCocktailByName()
    {
        global $Recettes;
        $cocktail = getCocktailByName("Aperol Spritz : cocktail italien pétillant", $Recettes);
        $this->assertTrue($cocktail == $Recettes[1]);
    }

    public function signUpUser()
    {
        session_start();
        $hashedPassword = password_hash($this->pwd, PASSWORD_BCRYPT);

        $user = array(
            "email" => $this->mail,
            "password" => $hashedPassword,
            "basket" => array()
        );

        $indexPath = realpath(dirname(__FILE__) .
            "/../data/") . "/testIndex";

        addEntryToAccountIndex($this->mail, $indexPath);

        $dataFilePath = realpath(dirname(__FILE__) .
            "/../data/") . "/" . $this->mail;

        storeUserData($dataFilePath, $user);
    }

    public function connectUser()
    {

        $indexPath = realpath(dirname(__FILE__) .
            "/../data/") . "/testIndex";

        $dataFilePath = getUsersDataFile($this->mail,
             $indexPath);

        $_SESSION["userDataFileName"] = $dataFilePath;
    }

    public function removeFiles()
    {
        $indexPath = realpath(dirname(__FILE__) .
            "/../data/") . "/testIndex";

        $dataFilePath = realpath(dirname(__FILE__) .
            "/../data/") . "/" . $this->mail;

        unlink($indexPath);
        unlink($dataFilePath);
    }

    public function testAddToBasketConnected()
    {
        global $Recettes;
        $this->signUpUser();
        $this->connectUser();
        $this->assertTrue(isConnected());
        addRecipeBasket($Recettes[0]);
        $basket = getUserBasket();
        $this->assertTrue($Recettes[0] == $basket[0]);
        $this->removeFiles();
    }
}

 ?>
