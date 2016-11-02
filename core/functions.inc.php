<?php
include_once("basket.inc.php");
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

//function getFirstSubcategories(&$hierarchie, &$firstSubCategory)
//{
//    foreach ($hierarchie as $category => $subCategories)
//    {
//        if (!isset($subCategories["super-categorie"]))
//        {
//            echo ('=>' . $category);
//        }
//    }
//}

// Takes an ingredient and returns an array of all the
// cocktails containing this ingredients.
function getAllCocktailsWithIngredient($ingredient, &$hierarchy, &$recettes)
{
    $ingredients;
    // Gets all subcategories of $ingredient and stores it in $ingredients.
    getAllSubcategories($ingredient, $hierarchy, $ingredients);
    // Iterates througs every $recettes to check if it has one of the
    // selected $ingredients.
    foreach ($recettes as $recette) {
        // Iterates through each $ingredientRecette of the current $recette
        // to check if it's in the selected $ingredients.
        foreach ($recette["index"] as $ingredientRecette) {
            if (array_search($ingredientRecette, $ingredients) !== false)
            {
                $ResRecettes[] = $recette;
            }
        }
    }

    $ResRecettes = array_unique($ResRecettes, SORT_REGULAR);
    return $ResRecettes;
}

/**
* @param $name The name of the cocktail to add to the basket
* @param $recettes The array of recipes
* @return The recipe (an array).
**/
function getCocktailByName($name, &$recettes)
{
    foreach ($recettes as $recette)
    {
        if ($recette["titre"] == $name)
        {
            return $recette;
        }
    }
}

function displayCocktail($recette)
{
    $cocktail_name = $recette["titre"];
    $cocktail_description = $recette["preparation"];
        
    //Get the image's path
    $cocktail_image = "../static/img/" . ucfirst(str_replace(' ', '_', $cocktail_name)) . ".jpg";
    
    // If the image doesn't exist take a generic image
    if (!file_exists($cocktail_image))
        $cocktail_image = "../static/img/Cuba_libre.jpg";
    
    // If it's ok, display the card
    if (!empty($cocktail_name) && !empty($cocktail_description) &&
        !empty($cocktail_image))
    {
?>
    <div class='col s6 m3'>
        <div class='card'>
            <div class='card-image'>
                <img src='<?= $cocktail_image ?>' alt='black-velvet' />
            </div>
            <div class='card-content'>
                <div class="center-align">
                    <span class='card-title orange-text darken-4'>
                        <?= $cocktail_name ?>
                    </span>
                </div>
                <p>
                    <?= $cocktail_description ?>
                </p>
            </div>
            <div class='card-action'>
                <a href='#' class="addToBasket"><span class="blue-text">Ajouter au panier</span></a>
                <a href='#'><span class="blue-text">Supprimer du panier</span></a>
            </div>
        </div>
    </div>
<?php
    }
}
?>
