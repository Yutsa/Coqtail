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
    getAllSubcategories($ingredient, $hierarchy, $ingredients);
    foreach ($recettes as $recette) {
        foreach ($recette["index"] as $ingredientRecette) {
                            print_r($ingredients);
            if (array_search($ingredient, $recette["index"]) !== false)
            {
                $ResRecettes[] = $recette;
            }
        }
    }

    $ResRecettes = array_unique($ResRecettes, SORT_REGULAR);
    return $ResRecettes;
}

function displayCocktail($recette)
{
    $cocktail_name = $recette["titre"];
    $cocktail_description = $recette["preparation"];
    $cocktail_image = "static/img/Cuba_libre.jpg";
    if (!empty($cocktail_name) && !empty($cocktail_description) &&
    !empty($cocktail_image))
    {
        ?>
        <div class='row'>
            <div class='col s6 offset-s3'>
                <div class='card'>
                    <div class='card-image'>
                        <img src='<?= $cocktail_image ?>' alt='black-velvet' />
                        </div>
                        <div class='card-content'>
                            <div class="center-align">
                            <span class='card-title orange-text darken-4'>
                            <?= $cocktail_name ?></span>
                        </div>
                            <p>
                                <?= $cocktail_description ?>
                            </p>
                        </div>
                        <div class='card-action'>
                            <a href='#'><span class="blue-text">Ajouter au panier prout</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
