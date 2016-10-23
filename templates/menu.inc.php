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
        <a href="#" class="brand-logo">Coq'tail</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><form>
                <div class="input-field">
                    <input id="search" type="search" required>
                    <label for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
                </form></li>
            <li><a href="<?php echo ROOT_URI ?>">Accueil</a></li>
            <li><a href="#" data-activates="slide-out" class="ingredients">Parcourir Ingrédients</a></li>
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



        <ul id="slide-out" class="side-nav black-text">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header">First</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li>
                <li>
                    <div class="collapsible-header">Second</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li>
                <li>
                    <div class="collapsible-header">Third</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li>
                <li><a href="#">Accueil</a></li>
                <li><a href="#" data-activates="mobile-demo" class="ingredients">Parcourir Ingrédients</a></li>
                <?php if (!$connected)
                { ?>
                    <li><a href='#'>Se connecter</a></li>
                    <li><a href='#'>S'inscrire</a></li>
          <?php } ?>
            </ul>
        </ul>

    </div>
</nav>
