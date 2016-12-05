<?php

function testMail($mail, &$mailError) 
{
    if(empty($mail) || $mail == "")
    {
        $mailError = "L'adresse mail est obligatoire";
        return true;
    }
    else if(!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/", $mail))
    {
        $mailError = "L'adresse mail n'est pas valide";
        return true;
    }
    return false;
}

function testPassword($password, &$passwordError) 
{
    if(empty($password) || $password == "")
    {
        $passwordError = "Le mot de passe est obligatoire.";
        return true;
    }
    else if(strlen($password) < 4)
    {
        $passwordError = "Le mot de passe est trop cours";
        return true;
    }
    return false;
}

function testFirstName($fisrtName, &$firstNameError) 
{
    if (!empty($fisrtName) &&
        preg_match("/[0-9]+/", $fisrtName))
    {
        $firstNameError = "Prénom incorrect.";
        return true;
    }
    return false;
}

function testName($name, &$nameError) 
{
    if (!empty($name) &&
        preg_match("/[0-9]+/", $name))
    {
        $nameError = "Nom incorrect.";
        return true;
    }
    return false;
}

function testPhone($phone, &$phoneError) 
{
    if (!empty($phone) &&
        !preg_match("/^0[0-9]{9}$/", $phone))
    {
        $phoneError = "Numéro de téléphone incorrect.";
        return true;
    }
    return false;
}

function testPostal($postal, &$postalError) 
{
    if (!empty($postal) &&
        !preg_match("/[0-9]{5}/", $postal))
    {
        $postalError = "Code postal incorrect.";
        return true;
    }
    return false;
}

function testVille($ville, &$villeError) 
{
    if (!empty($ville) &&
        !preg_match("/[a-z A-Z]+$/", $ville))
    {
        $villeError = "Ville incorrecte.";
        $hasError = true;
    }
    return false;
}








?>