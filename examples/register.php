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

    if(password_verify("1996edouard", $hashedPassword))
        echo "Password verified.";
    else
        echo "Password not verified.";
}
?>
