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

    if(isset($_POST["prenom"])) 
    {
        //Change with new value
        $userData["prenom"] = $_POST["prenom"];
        $userData["nom"] = $_POST["nom"];
        $userData["ville"] = $_POST["ville"];
        $userData["phone"] = $_POST["phone"];
        $userData["postal"] = $_POST["postal"];
        $userData["address"] = $_POST["address"];

        $userDataFileCopy = fopen($userDataFilePath . "copy", "a+");
        fwrite($userDataFileCopy, serialize($userData));
        unlink($userDataFilePath);

        copy($userDataFilePath . "copy", $userDataFilePath);
        unlink($userDataFilePath . "copy");

        $change = 'Vos infomations ont bien été changées.';
    }
    fclose($userDataFile);


    $prenom = '';
    $nom = '';
    $phone = '';
    $address = '';
    $postal = '';
    $ville = '';
    $naissance = '';

    if (!empty($userData["prenom"]))
    {
        $prenom = $userData["prenom"];
    }
    if (!empty($userData["nom"]))
    {
        $nom = $userData["nom"];
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
                            <p for="nom">Nom : </p>
                            <input id="nom" name="nom" type="text" class="validate" value="<?php echo $nom ?>">
                        </div>
                        <div class="input-field col s4">
                            <p for="nom">Prénom : </p>
                            <input id="prenom" name="prenom" type="text" class="validate" value="<?php echo $prenom ?>" />
                        </div>
                        <div class="input-field col s4">
                            <p>
                                <input name="sexe" type="radio" id="homme" value="homme"/>
                                <label for="homme">Homme</label>
                                <input name="sexe" type="radio" id="femme" value="femme"/>
                                <label for="femme">Femme</label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <p for="nom">Date de naissance : </p>
                            <input id="naissance" type="date" class="datepicker" value="<?php echo $naissance ?>" />
                        </div>
                        <div class="input-field col s6">
                            <p for="nom">Téléphone : </p>
                            <input type="text" name="phone" id="phone" value="<?php echo $phone ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <p for="nom">Adresse : </p>
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

        <script src="../static/js/custom.js" charset="utf-8"></script>

    </body>
</html>