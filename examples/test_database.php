<?php
$username = "DevWeb";
$password = "projetwebl3";

$test = '7';
$test2 = 'Robert';
try
{
    $bdd = new PDO('mysql:host=95.85.32.182;dbname=ProjetWeb;charset=utf8', $username, $password);
    $query = "INSERT INTO INGRÉDIENTS VALUES ($test, '$test2')";
    $bdd->exec($query);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
