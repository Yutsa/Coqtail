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
            <li><a href="#" data-activates="slide-out" class="ingredients">Parcourir Ingrédients</a></li>
            <?php if (!$connected) {
    echo "<li><a href='#'>Se connecter</a></li>\n";
    echo "\t\t\t\t<li><a href='#'>S'inscrire</a></li>\n";
} ?>
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
            </ul>
        </ul>

    </div>
</nav>

