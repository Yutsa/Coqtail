<?php


/*
* This is the file to include to show the menu.
* The options to connect or register shoudln't appear when logged in.
* An option to log out should appear when logged in.
*/

//TODO: Figure out when the user is connected or not.
//TODO: Show a log out button when logged in.

$connected = isset($_SESSION["userDataFileName"]);
define('ROOT_URI', "/Projet");

?>

<nav class="indigo darken-3">
    <div class="nav-wrapper">
        <a href="<?php echo ROOT_URI ?>" class="brand-logo">Coq'tail</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php echo ROOT_URI . "/templates/search.php"?>">Recherche</a></li>
            <li><a href="<?php echo ROOT_URI ?>">Accueil</a></li>
            <li><a href="<?php echo ROOT_URI . "/templates/cocktail_display.php"?>">Parcourir Ingrédients</a></li>

            <li><a href="<?php echo ROOT_URI . "/templates/basket.php"?>">Panier</a></li>
            <?php if (!$connected)
            { ?>
                <li><a href="<?php echo ROOT_URI . "/templates/login_page.php" ?>">Se connecter</a></li>
                <li><a href="<?php echo ROOT_URI . "/templates/register_form.php"?>">S'inscrire</a></li>
                <?php }
                else
                { ?>
                    <li><a href="<?php echo ROOT_URI . "/core/logout.php" ?>">Se déconnecter</a></li>
                    <?php } ?>
        </ul>

    <ul class="side-nav" id="mobile-demo">
        <li><a href="<?php echo ROOT_URI ?>">Accueil</a></li>
        <li><a href="<?php echo ROOT_URI . "/templates/cocktail_display.php"?>">Parcourir Ingrédients</a></li>
        <li><a href="<?php echo ROOT_URI . "/templates/basket.php"?>">Panier</a></li>
        <?php if (!$connected)
{ ?>
        <li><a href="<?php echo ROOT_URI . "/templates/login_page.php" ?>">Se connecter</a></li>
        <li><a href="<?php echo ROOT_URI . "/templates/register_form.php"?>">S'inscrire</a></li>
        <?php }
               else
               { ?>
        <li><a href="<?php echo ROOT_URI . "/core/logout.php" ?>">Se déconnecter</a></li>
        <?php } ?>
        <li><a href="<?php echo ROOT_URI . "/templates/search.php"?>">Recherche</a></li>
    </ul>

    </div>
</nav>
