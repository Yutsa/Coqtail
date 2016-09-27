<?php

//function GetSousCategories(&$Hierarchie, $name) {
//    
//    foreach ($Hierarchie[$name] as $SousCategories) {
//        foreach ($SousCategories as $SousCategorie) {
//            echo('L__ ' . $SousCategorie . '<br />');
//        }
//    }
//    
//    // pour chaque ingrédient
//    $query = "INSERT INTO ingrédients (id_ingredients," . $nom_ingredients . ")";
//    // pour chaque sous ingrédient
//    $query2 = "INSERT INTO categories (id_ingredients, ". $sous_ingredient1 . ")";
//    return $SousCategories;
//}

function Insert(&$Hierarchie) {
    
    try
    {
        $bdd = new PDO('mysql:host=95.85.32.182;dbname=ProjetWeb;charset=utf8', 'DevWeb', 'projetwebl3');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    
    $bdd->beginTransaction();
    
    $NomsIngredients = array_keys($Hierarchie);
    
    // Pour chaque ingrédient, on l'ajoute à la table des ingrédients
    for ($i = 0; $i < count($Hierarchie); $i++) {
        echo('Titre => ' . $NomsIngredients[$i] . '<br />');
        $query = "INSERT INTO ingrédients (" . $i . "," . $NomsIngredients[$i] . ");";
        $bdd->query($query);    
    }
    
    for ($i = 0; $i < count($Hierarchie); $i++) {
        echo('Titre => ' . $NomsIngredients[$i] . '<br />');
        // Pour toutes les sous-catégories de chaques ingrédients
        foreach ($Hierarchie[$NomsIngredients[$i]] as $SousCategories) {
            foreach ($SousCategories as $SousCategorie) {
                echo('L__ ' . $SousCategorie . '<br />');
                $queryNom = "SELECT id_ingrédient FROM INGREDIENTS WHERE nom_ingrédient == '" . $SousCategorie . "';";
                $resultat = $bdd->query($queryNom);
                $query2 = "INSERT INTO categories (" . $i . ", " . $resultat . ");";
                $bdd->query($query2);
            }
        }
    }
    
    $bdd->commit();
    
    $resultat->closeCursor();
    $bdd->close();
    
    
//    foreach ($Hierarchie as Ingredient) {
//        $i++;
//        
//        echo ('nom : ' . $NomsIngredients[$i]);
//        
//        foreach ($Ingredient as $SousCategorie) {
//            echo ('sous cat : ' . $SousCategorie[0]);
//        }
//    }
}

?>