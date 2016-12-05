<?php
// session_start();
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

    if(empty($_POST["email"]))
    {
        $mailRequired = "L'adresse mail est obligatoire";
        $hasError = true;
    }
    else if(!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/", $_POST["email"]))
    {
        $validMail = "L'adresse mail n'est pas valide";
        $hasError = true;
    }

    if(empty($_POST["password"]))
    {
        $passwordRequired = "Le mot de passe est obligatoire.";
        $hasError = true;
    }
    else if(strlen($_POST["password"]) < 4)
    {
        $passwordTooShort = "Le mot de passe est trop cours";
        $hasError = true;
    }

    if (!empty($_POST['nom']) &&
        preg_match("/[0-9]+/", $_POST["nom"]))
    {
        $nomError = "Nom incorrect.";
        $hasError = true;
    }

    if (!empty($_POST['prenom']) &&
        preg_match("/[0-9]+/", $_POST["prenom"]))
    {
        $prenomError = "Prénom incorrect.";
        $hasError = true;
    }

    if (!empty($_POST['phone']) &&
        !preg_match("/^0[0-9]{9}$/", $_POST["phone"]))
    {
        $phoneError = "Numéro de téléphone incorrect.";
        $hasError = true;
    }

    if (!empty($_POST['postal']) &&
        !preg_match("/[0-9]{5}/", $_POST["postal"]))
    {
        $postalError = "Code postal incorrect.";
        $hasError = true;
    }

    if (!empty($_POST['ville']) &&
        !preg_match("/[a-z A-Z]+$/", $_POST["ville"]))
    {
        $villeError = "Ville incorrecte.";
        $hasError = true;
    }

    if (!$hasError)
    {
        // This function provides a random salt.
        $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $user = array(
            "email" => $_POST["email"],
            "password" => $hashedPassword,
            "prenom" => $_POST["prenom"],
            "nom" => $_POST["nom"],
            "phone" => $_POST["phone"],
            "naissance" => $_POST["naissance"],
            "address" => $_POST["address"],
            "postal" => $_POST["postal"],
            "ville" => $_POST["ville"],
            "sexe" => $_POST["sexe"],
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
else
{

}
?>
