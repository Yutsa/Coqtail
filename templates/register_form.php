<?php
include_once("../core/basket.inc.php");
// If the user is connected, this page should redirect to the home page.

// Initializes the error message if they're not set.
if (!isset($nomError)) $nomError = '';
if (!isset($errorMessage)) $errorMessage = '';
if (!isset($prenomError)) $prenomError = '';
if (!isset($mailRequired)) $mailRequired = '';
if (!isset($passwordRequired)) $passwordRequired = '';
if (!isset($validMail)) $validMail = '';
if (!isset($passwordTooShort)) $passwordTooShort = '';



if (isset($_SESSION["username"]))
    header('Location: ../index.php');
if (isset($_POST["email"]))
    include_once("../core/register_user.php");

// Initializes field values
isset($_POST['nom']) ? $nom = $_POST['nom'] : $nom = '';
isset($_POST['email']) ? $email = $_POST['email'] : $email = '';
isset($_POST['prenom']) ? $prenom = $_POST['prenom'] : $prenom = '';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coq'Tail - S'enregistrer</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../static/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include_once 'favicon.inc.php'; ?>
    </head>
    <body>
        <?php include_once 'menu.inc.php' ?>

        <div class="container">
            <div class="row">
                <h1>S'inscrire</h1>
            </div>
            <div class="row">
                <form class="col s12" action="#" method="post">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="email" name="email" type="email" class="validate" value="<?php echo $email ?>" required="" aria-required="true">
                            <label for="email">Email *</label>
                            <?=  $mailRequired; ?>
                            <?=  $validMail; ?>
                            <?=  $errorMessage; ?>
                        </div>
                        <div class="input-field col s6">
                            <input id="password" name="password" type="password" class="validate" required="" aria-required="true">
                            <label for="password">Mot de passe *</label>
                            <?=  $passwordRequired; ?>
                            <?=  $passwordTooShort; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input id="nom" name="nom" type="text" class="validate" value="<?php echo $nom ?>">
                            <label for="nom">Nom</label>
                            <span style="color:red"><?= $nomError ?> </span>
                        </div>
                        <div class="input-field col s4">
                            <input id="prenom" name="prenom" type="text" class="validate" value="<?php echo $prenom ?>">
                            <label for="prenom">Prénom</label>
                            <span style="color:red"><?= $prenomError ?> </span>
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
                            <input id="naissance" type="date" class="datepicker">
                            <label for="naissance">Date de naissance</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="phone" id="phone"/>
                            <label for="phone">Numéro de téléphone</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input type="text" name="address" id="address"/>
                            <label for="address">Adresse</label>
                        </div>
                        <div class="input-field col s4">
                            <input type="text" name="postal" id="postal"/>
                            <label for="postal">Code postal</label>
                        </div>
                        <div class="input-field col s4">
                            <input type="text" name="ville" id="ville"/>
                            <label for="ville">Ville</label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light col s4 offset-s4 " type="submit" name="action">
                            S'inscrire<i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
                <p>Seuls les champs marqués d'un * sont obligatoires.</p>
            </div>
        </div>

        <script type="text/javascript" src="../static/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../static/js/materialize.min.js"></script>
        <script src="../static/js/custom.js" charset="utf-8"></script>
        <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    </body>
</html>
