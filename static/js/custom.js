$(document).ready(function() {
    $(".ingredients").sideNav();
});


$(document).ready(function(){
    $('.collapsible').collapsible({
        accordion : false
    });
});

$(".button-collapse").sideNav();

/*
    Event listener when the user clicks on a category.
    It displays the subcategories and the cocktails of this
    category, using ajax.
*/
$('body').on('click', 'div.collapsible-header', function() {
    var urlDisplaySubcategories = '/Projet/core/ajax_display_subcategories.php';

    var nextCollapsible = $(this).next();
    var categorie = $(this).text();

    $("div.collapsible-header").removeClass('blue');
    $(this).addClass('blue');

    $.post(urlDisplaySubcategories, { cat : categorie }, function(data) {
        nextCollapsible.html(data);

        nextCollapsible.children().collapsible({
            accordion: true
        });
    });

    var urlDisplayRecipes = '/Projet/core/ajax_display_recette.php';
    $.post(urlDisplayRecipes, { cat : categorie }, function(data) {
        $("div#recette").html(data);
    });
});

/**
* A function that gets the title of the coktail that has been clicked on.
* @param cocktail The button of the cocktail you want to get the title of.
* @return The title of the cocktail
**/
function getTitle(cocktail) {
    return $(cocktail).parent().prev().children(".card-title").children(".title").text();
}

/**
* A function that sends the Ajax request to either add or remove a cocktaial
* from the basket.
* @param action The action to perform, either "add" or "remove".
* @param cocktailButton The object of the button that has been clicked.
**/
function sendAjaxModifyBasket(action, cocktailButton)
{
    var titre = getTitle(cocktailButton);
    titre = titre.trim();

    var url = "/Projet/core/basket.inc.php";
    console.log(titre);
    $.post(url, {titre: titre, action: action}, function(data) {
        console.log(data);
    });
}

$('body').on('click', 'button.addToBasket', function() {
    sendAjaxModifyBasket("add", this);
});

$('body').on('click', 'button.removeFromBasket', function() {
    sendAjaxModifyBasket("remove", this);
});
