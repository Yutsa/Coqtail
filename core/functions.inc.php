<?php

    // Takes a category as parameter and returns an array of all
    // its subcategories. The hierarchy array must be passed as
    // parameter too.
    function getSubcategory($searchedCategory, &$hierarchie)
    {
        foreach ($hierarchie as $category => $subSuperCategories) {
            if ($searchedCategory === $category)
            {
                return $subSuperCategories["sous-categorie"];
            }
        }
    }

    // Takes a category, the categories hierarchy and
    // an array to store all the ingredients as parameter
    // and returns an array of ALL ingredients in this category

    function getAllSubcategories($searchedCategory, &$hierarchie, &$ingredientsArray)
    {
        $ingredientsArray[] = $searchedCategory;

        foreach ($hierarchie as $category => $subSuperCategories) {
            if ($searchedCategory === $category)
            {
                if (isset($subSuperCategories["sous-categorie"]))
                {

                    foreach ($subSuperCategories["sous-categorie"] as $subcategory) {
                        $ingredientsArray[] = $subcategory;
                        getAllSubcategories($subcategory, $hierarchie, $ingredientsArray);
                    }
                }
            }
        }
    }

    // Takes an ingredient and returns an array of all the
    // cocktails containing this ingredients.
    function getAllCocktailsWithIngredient($ingredient, &$hierarchy, &$recettes)
    {
        $ingredients;
        $ResRecettes = array();
        getAllSubcategories($ingredient, $hierarchy, $ingredients);
        foreach ($recettes as $recette) {
            foreach ($recette["index"] as $ingredientRecette) {
                if (array_search($ingredient, $recette["index"]) !== false)
                {
                    $ResRecettes[] = $recette["titre"];
                }
            }
        }

        $ResRecettes = array_unique($ResRecettes);
        return $ResRecettes;
    }
?>
