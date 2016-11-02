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
    var url = 'core/ajax.php';

    var nextCollapsible = $(this).next();
    var categorie = $(this).text();

    //console.log($(this).parent().parent().prop('tagName'));

    //$(this).parent().parent().addClass('blue');

    $.post(url, { cat : categorie }, function(data) {
        //nextCollapsible.empty();
        nextCollapsible.html(data);

        //console.log(nextCollapsible.children().text());
        //console.log(nextCollapsible.children().prop('tagName'));

        nextCollapsible.children().collapsible({
            accordion: true
        });

        //$(this).addClass('active');

        //alert(data);
    });
});

$('body').on('click', 'a.addToBasket', function() {
    var titre = $(this).parent().parent().children().next().children().children(".card-title").text();

    var url = "/Projet/core/basket.inc.php";

    $.post(url, {titre: titre}, function(data) {
        console.log(data);
    });
});
