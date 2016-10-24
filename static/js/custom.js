$(document).ready(function() {
    $(".ingredients").sideNav();
});


$(document).ready(function(){
    $('.collapsible').collapsible({
        accordion : false
    });
});


$('.collapsible-header').click(function() {
   var url = 'core/ajax.php';

   //alert("clicked");

   var nextCollapsible = $(this).next();
   var categorie = $(this).text();
   //alert(categorie);

   $.post(url, { cat : categorie }, function(data) {
       $(nextCollapsible).empty();
       $(nextCollapsible).append(data);
       //alert(data);
   });
});
