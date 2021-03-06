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

    $ingredientsArray = array_unique($ingredientsArray);
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

function getAllCocktailsWithoutIngredient($ingredient, &$hierarchy, &$recettes)
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
            if (array_search($ingredientRecette, $ingredients) === false)
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

    $ingredients = explode('|', $recette['ingredients']);

    $cocktail_ingredients = '<ul class="collection">';

    foreach($ingredients as $ingredient)
    {
        $cocktail_ingredients = $cocktail_ingredients . '<li class="collection-item blue lighten-5">' . $ingredient . '</li>';
    }

    $cocktail_ingredients =  $cocktail_ingredients . '</ul>';

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

<div class='col s12 m6 l3'>
    <div class="card sticky-action">
        <div class="card-image waves-effect waves-block waves-light crop">
            <img class="activator img" src='<?= $cocktail_image ?>' alt='black-velvet' />
        </div>
        <div class="card-content">
            <span class="card-title activator orange-text darken-4 truncate center">
                <?= $cocktail_name ?>
                <br />
                <i class="material-icons center">more_vert</i>
            </span>
        </div>
        <div class="card-reveal transparence">
            <span class="card-title orange-text darken-4 center">
                <span class="title">
                    <?= $cocktail_name ?>
                </span>
                <br />
                <i class="material-icons center">close</i>
            </span>
            <div><?php print_r($cocktail_ingredients);?></div>
            <p><?= $cocktail_description ?></p>
        </div>
        <div class='card-action center'>
            <?php
        if (searchRecipeInBasket($recette) === false)
        {
            ?>
            <button class="addToBasket waves-effect waves-light btn-flat indigo darken-3"><span class="white-text">Ajouter <i class="material-icons center">shopping_cart</i></span></button>
            <?php }
     else
     {
            ?>
            <button class="removeFromBasket waves-effect waves-light btn-flat indigo darken-3"><span class="white-text">Supprimer <i class="material-icons center">shopping_cart</i></span></button>
            <?php } ?>
        </div>
    </div>
</div>

<?php
    }
}
?>
