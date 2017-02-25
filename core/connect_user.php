<?php
    include_once("basket.inc.php");
    //session_start();
    /*
    * This page is handling the connection process. It checks if the user is
    * registered. If it is then it checks if the password is corrected.
    */

    $indexFilePath = "../data/account_index";


    /**
    * Gets the path data file of a user.
    * @param $email The email adress of the user trying to
    * connect
    * @param $indexFilePath The path to the index file
    * @throws Exception if the users email isn't in the index.
    * @return The path to the user's data file.
    **/
    function getUsersDataFile($email, $indexFilePath)
    {
        //Todo throw exception if not valid mail
        $fileHandle = fopen($indexFilePath, "a+");
        while (($line = fgets($fileHandle)) != false)
        {
            $indexData = explode(":", $line);
            $currentMail = $indexData[0];
            $currentPath = $indexData[1];
            if ($email == $currentMail)
                return trim($currentPath);
        }
        throw new Exception("Email not found");
    }

    /**
    * @param $email The email address of the user.
    * @param $password The password of the user.
    * @return True if the password is correct, False otherwise.
    **/
    function checkPassword($email, $password, $dataFilePath)
    {
        $handle = fopen($dataFilePath, "r");
        $userData = unserialize(fgets($handle));

        /* Verify the password from param and from the data file */
        return password_verify($password, $userData["password"]);
    }

    if (isset($_POST["email"]) && isset($_POST["password"]))
    {
        try
        {
            $dataFilePath = getUsersDataFile($_POST["email"],
             $indexFilePath);

            if (!checkPassword($_POST["email"], $_POST["password"],
             $dataFilePath))
            {
                throw new Exception("Mot de passe incorrect.");
            }

            $_SESSION["userDataFileName"] = $dataFilePath;
            basketFusion();
            header("Location: ../index.php");
        }
        catch (Exception $e)
        {
            $errorMessage = "Email ou mot de passe invalide.";
        }

    }
?>
