<?php
/*
    This page is the landing point when a user registers. Verification of the
    inputs will be done client side on the form page.
*/
if (isset($_POST["email"]) && isset($_POST["password"]))
{
    // This function provides a random salt.
    $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $user = array(
        "email" => $_POST["email"],
        "password" => $hashedPassword
    );
    $accountIndex = fopen("../data/accounts_index", "a+");
    // The file is empty
    if (filesize("../data/accounts_index") === 0)
        // Each index line will be the email and the path to the file where the user's data is stored.
        $indexEntry = $user["email"] . ":../data/" . $user["email"];

        fwrite($accountIndex, $indexEntry);

        // We get the path to the file where we'll store the user's data, we open/create the file and write in it.
        $pathToUserData = explode(":", $indexEntry);
        $userDataFile = fopen($pathToUserData[1], "a");
        fwrite($userDataFile, "This is a test");
}
?>
