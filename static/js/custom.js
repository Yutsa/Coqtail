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

$('body').on('click', 'button.addToBasket', function() {
    var titre = $(this).parent().prev().children(".card-title").children(".title").text();

    titre = titre.trim();

//    console.log(titre);

    var url = "/Projet/core/basket.inc.php";

    $.post(url, {titre: titre}, function(data) {
        console.log(data);
    });
});
