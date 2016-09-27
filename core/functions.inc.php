<?php

function GetSousCategories($name) {
    
    foreach ($Hierarchie[$name] as $SousCategories) {
        foreach ($SousCategories as $SousCategorie) {
            echo('L__ ' . $SousCategorie . '<br />');
        }
    }
    return $SousCategories;
}

?>