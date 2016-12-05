<?php

include_once("../core/functions.inc.php");
include_once("../core/donnees.inc.php");
//define("indexFilePath", "../data/accounts_index");
//session_start();


if(isConnected())
{
    $change = '';

    $userDataFileName = $_SESSION["userDataFileName"];
    $userDataFilePath = "../data/" . $userDataFileName;
    $userDataFile = fopen($userDataFilePath, "a+");
    $userData = unserialize(fgets($userDataFile));
    //print_r($userData);

    $email = $userData["email"];
    $password = $userData["password"];

    if(isset($_POST["firstname"]))
    {
        //Change with new value
        $userData["firstname"] = $_POST["firstname"];
        $userData["name"] = $_POST["name"];
        $userData["ville"] = $_POST["ville"];
        $userData["phone"] = $_POST["phone"];
        $userData["postal"] = $_POST["postal"];
        $userData["address"] = $_POST["address"];
        $userData["naissance"] = $_POST["naissance"];
        $userData["sexe"] = $_POST["sexe"];

        $userDataFileCopy = fopen($userDataFilePath . "copy", "a+");
        fwrite($userDataFileCopy, serialize($userData));
        unlink($userDataFilePath);

        copy($userDataFilePath . "copy", $userDataFilePath);
        unlink($userDataFilePath . "copy");

        $change = 'Vos infomations ont bien été changées.';
    }
    fclose($userDataFile);


    $firstname = '';
    $name = '';
    $phone = '';
    $address = '';
    $postal = '';
    $ville = '';
    $naissance = '';
    $homme = false;
    $femme = false;

    if (!empty($userData["firstname"]))
    {
        $firstname = $userData["firstname"];
    }
    if (!empty($userData["name"]))
    {
        $name = $userData["name"];
    }
    if (!empty($userData["phone"]))
    {
        $phone = $userData["phone"];
    }
    if (!empty($userData["address"]))
    {
        $address = $userData["address"];
    }
    if (!empty($userData["postal"]))
    {
        $postal = $userData["postal"];
    }
    if (!empty($userData["ville"]))
    {
        $ville = $userData["ville"];
    }
    if (!empty($userData["naissance"]))
    {
        $naissance = $userData["naissance"];
    }
    if (!empty($userData["sexe"]))
    {
        if ($userData["sexe"] == "homme")
        {
            $homme = true;
        }
        else if ($userData["sexe"] == "femme")
        {
            $femme = true;
        }
    }
}
else
{
    echo("<p>Vous n'êtes pas connecté.</p>");
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - Se connecter</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../static/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include_once('favicon.inc.php'); ?>
    </head>
    <body>
        <?php include_once 'menu.inc.php' ?>

        <div class="container">
            <div class="row">
                <h1>Profil de <?php echo $email ?></h1>
            </div>
            <div class="row">
                <h4 class="green"><?php echo $change ?></h4>
            </div>
            <div class="row">
                <form class="col s12" action="#" method="post">
                    <div class="row">
                        <div class="input-field col s4">
                            <p for="name">Nom : </p>
                            <input id="name" name="name" type="text" class="validate" value="<?php echo $name ?>">
                        </div>
                        <div class="input-field col s4">
                            <p for="firstname">Prénom : </p>
                            <input id="firstname" name="firstname" type="text" class="validate" value="<?php echo $firstname ?>" />
                        </div>
                        <div class="input-field col s4">
                            <p>
                                <input name="sexe" type="radio" id="homme" value="homme" <?php echo $homme ? "checked" : "";  ?>/>
                                <label for="homme">Homme</label>
                                <input name="sexe" type="radio" id="femme" value="femme" <?php echo $femme ? "checked" : "";  ?>/>
                                <label for="femme">Femme</label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <p>Date de naissance : </p>
                            <input id="naissance" type="date" class="datepicker" name="naissance" value="<?php echo $naissance ?>" />
                        </div>
                        <div class="input-field col s6">
                            <p>Téléphone : </p>
                            <input type="text" name="phone" id="phone" value="<?php echo $phone ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <p>Adresse : </p>
                            <input type="text" name="address" id="address" value="<?php echo $address ?>"/>
                        </div>
                        <div class="input-field col s4">
                            <p for="nom">Code postal : </p>
                            <input type="text" name="postal" id="postal" value="<?php echo $postal ?>"/>
                        </div>
                        <div class="input-field col s4">
                            <p for="nom">Ville : </p>
                            <input type="text" name="ville" id="ville" value="<?php echo $ville ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light col s4 offset-s4 " type="submit" name="action">
                            Changer pour ces informations
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="row">
                <h4>Changer de mot de passe</h4>
            </div>
            <div class="row">
                <form class="col s12" action="#" method="post">
                    <div class="input-field col s6">
                        <input id="password" name="password" type="password" class="validate" required="" aria-required="true">
                        <label for="password">Mot de passe</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="newPassword" name="newPassword" type="password" class="validate" required="" aria-required="true">
                        <label for="newPassword">Nouveau mot de passe</label>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light col s4 offset-s4 " type="submit" name="action">
                            Changer de mot de passe
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../static/js/materialize.min.js"></script>
        <script src="../static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>

    </body>
</html>
