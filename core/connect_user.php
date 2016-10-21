<?php
    /*
    * This page is handling the connection process. It checks if the user is
    * registered. If it is then it checks if the password is corrected.
    */


    /**
    * @param $email The email adress of the user trying to
    * connect
    * @param $indexFilePath The path to the index file
    * @return True if the user exists, False otherwise
    **/
    function checkIfUserExists($email, $indexFilePath)
    {
        $fileHandle = fopen($indexFilePath, "a+");
        while (($line = fgets($fileHandle)) != false)
        {
            $indexDate = explode(":", $line);
            $currentMail = $indexDate[0];
            if ($email == $currentMail)
                return true;
        }
        return false;
    }

    /**
    * @param $email The email address of the user.
    * @param $password The password of the user.
    * @return True if the password is correct, False otherwise.
    **/
    function checkPassword($email, $password)
    {

    }

    if (isset($_POST["email"]) && isset($_POST["password"]))
    {
        if (!checkIfUserExists($_POST["email"],
            $indexFilePath))
        {
            echo "non";
            $errorMessage = "Mot de passe ou nom de compte incorrect";
        }
        else {
            echo "oui";
        }

    }
?>
