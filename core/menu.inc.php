<?php
    $connected = false;
 ?>
<nav>
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
                <li><a href="#">Parcourir ingrédients</a></li>
                <?php if (!$connected) {
                    echo "<li><a href='#'>Se connecter</a></li>\n";
                    echo "\t\t\t\t<li><a href='#'>S'inscrire</a></li>\n";
                } ?>
            </ul>
        </div>
    </nav>
