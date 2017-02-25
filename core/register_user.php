<?php
include_once("functions_user.php");

/*
    This page is the landing point when a user registers. Verification of the
    inputs will be done client side on the form page.
*/

/**
* Adds an entry for a user to the account index
* @param $email The email adress of the user.
* @throws Throws and Exception when the email is already used.
**/
function addEntryToAccountIndex($email, $indexFilePath)
{
    $dataDir = "../data/";
    if (!is_dir($dataDir))
    {
        mkdir($dataDir);
    }

    $fileHandle = fopen($indexFilePath, "a+");
    $indexEntry = $email . ":../data/" . $email . "\n";

    // If the index file is empty we add the index without verification
    if (filesize($indexFilePath) === 0)
        fwrite($fileHandle, $indexEntry);
    else
    {
        // We check that the email isn't already used.
        while (($line = fgets($fileHandle)) !== false)
        {
            $currentEmail = explode(":", $line)[0];
            if ($email === $currentEmail)
            {
                throw new Exception("Email already used");
            }
        }

        // The email hasn't been used
        fwrite($fileHandle, $indexEntry);
        fclose($fileHandle);
    }
}

/**
 * @param $userDataFilePath The path to the user's data file.
 * @param $userData The user's data to be stored
**/
function storeUserData($userDataFilePath, $userData)
{
    $userDataFile = fopen($userDataFilePath, "a");
    fwrite($userDataFile, serialize($userData));
    fclose($userDataFile);
}


if (isset($_POST["email"]) && isset($_POST["password"]))
{
    $hasError = false;
    $indexEntry; // The variable that will store the index entry of the user.

    //Tests all fields value
    if (testMail($_POST["email"], $mailError))
        $hasError = true;

    if (testPassword($_POST["password"], $passwordError))
        $hasError = true;

    if (testName($_POST["name"], $nameError))
        $hasError = true;

    if (testFirstName($_POST["firstname"], $firstNameError))
        $hasError = true;

    if (testVille($_POST["ville"], $villeError))
        $hasError = true;

    if (testPostal($_POST["postal"], $postalError))
        $hasError = true;

    if (testPhone($_POST["phone"], $phoneError))
        $hasError = true;

    //If there are no errors
    if (!$hasError)
    {
        // This function provides a random salt.
        $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
        //Set user with new value
        $user = array(
            "email" => $_POST["email"],
            "password" => $hashedPassword,
            "firstname" => $_POST["firstname"],
            "name" => $_POST["name"],
            "phone" => $_POST["phone"],
            "naissance" => $_POST["naissance"],
            "address" => $_POST["address"],
            "postal" => $_POST["postal"],
            "ville" => $_POST["ville"],
            "basket" => array()
        );

        try
        {
            $accountIndexPath = "../data/account_index";
            addEntryToAccountIndex($user["email"],
                                   $accountIndexPath);
            $DataFilePath = "../data/" . $user["email"];
            storeUserData($DataFilePath, $user);

            //Connect user if register succes
            include_once("../core/connect_user.php");
            //Redirect user on a succes page
            header("Location: registration_success.php");
        }
        catch (Exception $e)
        {
            $errorMessage = "Adresse mail déjà utilisée.";
        }
    }
}

?>
