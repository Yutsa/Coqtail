var availableTags = [];

$(function initAutoComplete() {
    $("#tags").autocomplete({
        source: availableTags,
        select: function (event, ui) {
            //Add the selected aliment to the list of all aliment
            $('#list').prepend('<div class="chip add green">' + ui.item.value + '<i class="close material-icons">close</i></div>');

            //Delete input value
            ui.item.value = "";
        } 
    });
});


//Get all the element need to autocomplete from php array
$('document').ready(function() {
    //Get url of ajax file
    var url = "/Projet/core/ajax_get_all_sub_cat.php";

    //Ajax request to get ingredients array
    $.post(url, {}, function(data) {

        //Split return array
        data = [data.split(":")];

        //Init javascript array 
        for (var i = 0; i < data[0].length; i++)
        {
            availableTags.push({value : data[0][i]});
        }

        //Add js array to #autocompleteState element (search bar)
        //$('#autocompleteState').data('array', availableTags);

    });

    //Event, when click on chip ingredient search
    //Inverse class (add to remove or remove to add)
    $('#list').on('click', 'div.chip', function() {
        if($(this).hasClass('add')) {
            $(this).removeClass('add');
            $(this).removeClass('green');
            $(this).addClass('remove');
            $(this).addClass('red');
        }
        else
        {
            $(this).removeClass('remove');
            $(this).removeClass('red');
            $(this).addClass('add');
            $(this).addClass('green');
        }
    });

    //Event when #list sub-DOM modified or click
    //Display recites in function of search bar
    $('#list').on('DOMSubtreeModified click', function() {
        var addElement = [];
        var removeElement = [];

        //Iterate though <li> and check if it has add or remove class
        $(this).children().each(function(index, element) {
            //Initialize 2 array 

            //One with the add ingredients
            if (element.className === 'chip add green' )
            {
                //console.log('add -> ' + element.textContent);
                addElement.push(element.textContent.slice(0,-5));
            }

            //An other with the remove ingredients
            if (element.className === 'chip remove red' )
            {
                //console.log('remove -> ' + element.textContent);
                removeElement.push(element.textContent.slice(0,-5));
            }

        })
        //console.log(addElement);
        //console.log(removeElement);

        //Ajax request for display recite match with arrays
        var url = "/Projet/core/ajax_get_search_cat.php";

        $.post(url, {addElement : addElement, removeElement: removeElement}, function(data) { 
            //Set result in a div
            $('div#displaySearch').html(data);
        });
    });
});


