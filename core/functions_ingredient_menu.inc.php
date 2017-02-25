<?php

include_once("functions.inc.php");

//include_once(realpath(dirname(__FILE__) .
//                      "/core/functions.inc.php"));
// Take a cateory and display all of its sub-categories
// in a menu
function displayMenuItem($categorie, &$hierarchie)
{
    // If the sub-cat exist
    if (isset($hierarchie[$categorie]['sous-categorie']))
    {
        // Gets all sub-cat
        $listAliment = getSubcategory($categorie, $hierarchie)

?>
<ul class="collapsible" data-collapsible="accordion">
    <?php
            // Diplay sub menu for each sub-categories
            foreach ($listAliment as $Aliment)
            {
    ?>
    <li>
        <div class="collapsible-header" id="collapsible-header"><?php echo($Aliment); ?></div>
        <div class="collapsible-body"></div>
    </li>
    <?php
            }
    }
    // Else if the cateory don't have any sub-cat
    else
    {
        // Test for diplay
    ?>
    <!--        <div><a class="waves-effect waves-light btn">Ajouter à la recherche</a></div>-->
    <?php
    }
    ?>
</ul>
<?php
}
?>
