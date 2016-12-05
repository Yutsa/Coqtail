<?php

include_once("../core/functions.inc.php");
include_once("../core/donnees.inc.php");
include_once("../core/functions_user.php");

if(isConnected())
{
    //Initialize error variable
    if (!isset($mailError)) $mailError = '';
    if (!isset($passwordError)) $passwordError = '';

    if (!isset($nameError)) $nameError = '';
    if (!isset($firstNameError)) $firstNameError = '';

    if (!isset($phoneError)) $phoneError = '';
    if (!isset($postalError)) $postalError = '';
    if (!isset($villeError)) $villeError = '';
    if (!isset($passwordError)) $passwordError = '';
    if (!isset($newPasswordError)) $newPasswordError = '';
    $change = '';

    //Initialize paths
    $userDataFileName = $_SESSION["userDataFileName"];
    $userDataFilePath = "../data/" . $userDataFileName;
    $userDataFile = fopen($userDataFilePath, "a+");
    $userData = unserialize(fgets($userDataFile));

    $email = $userData["email"];
    $password = $userData["password"];

    //If Post is send for 1st form
    if(isset($_POST["firstname"]))
    {
        //Check all input of form
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

        //If there is no error 
        if (!$hasError)
        {
            //Change userdata with new value
            $userData["firstname"] = $_POST["firstname"];
            $userData["name"] = $_POST["name"];
            $userData["ville"] = $_POST["ville"];
            $userData["phone"] = $_POST["phone"];
            $userData["postal"] = $_POST["postal"];
            $userData["address"] = $_POST["address"];
            $userData["naissance"] = $_POST["naissance"];
            $userData["sexe"] = $_POST["sexe"];
            //Message display
            $change = 'Vos infomations ont bien été changées.';
        }
    }

    //If post is send for 2nd form
    if(isset($_POST["password"]) && isset($_POST["newpassword"]))
    {
        //If input are full
        if (!empty($_POST["password"]) && !empty($_POST["newpassword"]))
        {
            //Verify if actual password is good
            if (password_verify($_POST["password"], $userData["password"]))
            {
                //Change with new password
                $newPassword = password_hash($_POST["newpassword"], PASSWORD_BCRYPT);
                $userData["password"] = $newPassword;
                $change = 'Vos infomations ont bien été changées.';
            }
            else 
            {
                $passwordError = "Mot de passe invalide";
            }
        }
        else
        {
            if (empty($_POST["password"]))
            {
                $passwordError = 'Mot de passe requis';
            }
            if (empty($_POST["newpassword"]))
            {
                $newPasswordError = 'Nouveau mot de passe requis';
            }
        }
    }

    //Copy the new informations in the save file
    $userDataFileCopy = fopen($userDataFilePath . "copy", "a+");
    fwrite($userDataFileCopy, serialize($userData));
    unlink($userDataFilePath);

    copy($userDataFilePath . "copy", $userDataFilePath);
    unlink($userDataFilePath . "copy");

    fclose($userDataFile);

    //Initaliaze the fields for input
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
                            <span style="color:red"><?= $nameError ?> </span>
                        </div>
                        <div class="input-field col s4">
                            <p for="nom">Prénom : </p>
                            <input id="firstname" name="firstname" type="text" class="validate" value="<?php echo $firstname ?>" />
                            <span style="color:red"><?= $firstNameError ?> </span>
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
                            <span style="color:red"><?= $phoneError ?> </span>
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
                            <span style="color:red"><?= $postalError ?> </span>
                        </div>
                        <div class="input-field col s4">
                            <p for="nom">Ville : </p>
                            <input type="text" name="ville" id="ville" value="<?php echo $ville ?>"/>
                            <span style="color:red"><?= $villeError ?> </span>
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
                        <span style="color:red"><?= $passwordError ?> </span>
                    </div>
                    <div class="input-field col s6">
                        <input id="newpassword" name="newpassword" type="password" class="validate" required="" aria-required="true">
                        <label for="newpassword">Nouveau mot de passe</label>
                        <span style="color:red"><?= $newPasswordError ?> </span>
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
