$(document).ready(function() {
    $(".ingredients").sideNav();
});


$(document).ready(function(){
    $('.collapsible').collapsible({
        accordion : false
    });
});

$(".button-collapse").sideNav();

$('body').on('click', 'div.collapsible-header', function() {
    var url = '/Projet/core/ajax.php';

    var nextCollapsible = $(this).next();
    var categorie = $(this).text();

    $("div.collapsible-header").removeClass('blue');
    $(this).addClass('blue');

    $.post(url, { cat : categorie }, function(data) {
        nextCollapsible.html(data);

        nextCollapsible.children().collapsible({
            accordion: true
        });
    });

    var url2 = '/Projet/core/ajax_display_recette.php';
    $.post(url2, { cat : categorie }, function(data) {
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
