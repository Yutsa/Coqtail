<?php
    $connected = false;
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
                <li><a href="#">Accueil</a></li>
                <li><a href="#" data-activates="mobile-demo" class="ingredients">Parcourir Ingrédients</a></li>
                <?php if (!$connected) {
                    echo "<li><a href='#'>Se connecter</a></li>\n";
                    echo "\t\t\t\t<li><a href='#'>S'inscrire</a></li>\n";
                } ?>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="sass.html">Michel</a></li>
                <li><a href="badges.html">Alfred</a></li>
                <li><a href="collapsible.html">Caca</a></li>
                <li><a href="mobile.html">Robert</a></li>
            </ul>
        </div>
    </nav>
