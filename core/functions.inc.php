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
        $username = "DevWeb";
        $password = "projetwebl3";
        $bdd = new PDO('mysql:host=95.85.32.182;dbname=ProjetWeb;charset=utf8', $username, $password);

        $NomsIngredients = array_keys($Hierarchie);

        // Pour chaque ingrédient, on l'ajoute à la table des ingrédients
        for ($i = 0; $i < count($Hierarchie); $i++) {
            //echo('Titre => ' . $NomsIngredients[$i] . '<br />');
            $nomIngredient = $NomsIngredients[$i];
            $query = "INSERT INTO INGRÉDIENTS VALUES ('$i', '$nomIngredient');";
            $bdd->exec($query);
        }

        for ($i = 0; $i < count($Hierarchie); $i++) {
            $nomIngredient = $NomsIngredients[$i];
            //echo('Titre => ' . $NomsIngredients[$i] . '<br />');
            // Pour toutes les sous-catégories de chaques ingrédients
            foreach ($Hierarchie[$NomsIngredients[$i]] as $SousCategories) {
                foreach ($SousCategories as $SousCategorie) {
                    //echo('L__ ' . $SousCategorie . '<br />');
                    $queryNom = "SELECT id_ingrédient FROM INGRÉDIENTS WHERE nom_ingrédient = 'Crème fraiche'";
                    $resultat = $bdd->exec($queryNom);
                    print_r($resultat);
                    /*$query2 = "INSERT INTO CATEGORIE VALUES ('$i', '$resultat');";
                    $bdd->exec($query2);*/
                    $resultat->closeCursor();
                }
            }
        }
        $bdd->close();
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }


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
