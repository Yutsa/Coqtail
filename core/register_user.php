<?php
/*
    This page is the landing point when a user registers. Verification of the
    inputs will be done client side on the form page.
*/
if (isset($_POST["email"]) && isset($_POST["password"]))
{
    $indexEntry; // The variable that will store the index entry of the user.

    // This function provides a random salt.
    $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $user = array(
        "email" => $_POST["email"],
        "password" => $hashedPassword,
        "basket" => array()
    );

    try
    {
        addEntryToAccountIndex($user["email"]);
        $DataFilePath = "../data/" . $user["email"];
        storeUserData($DataFilePath, $user);
        header("Location: registration_success.php");
    }
    catch (Exception $e)
    {
        $errorMessage = "Adresse mail déjà utilisée.";
    }
}

/**
* Adds an entry for a user to the account index
* @param $email The email adress of the user.
* @throws Throws and Exception when the email is already used.
**/
function addEntryToAccountIndex($email)
{
    $fileHandle = fopen("../data/accounts_index", "a+");
    $indexEntry = $email . ":../data/" . $email . "\n";

    // If the index file is empty we add the index without verification
    if (filesize("../data/accounts_index") === 0)
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
?>
