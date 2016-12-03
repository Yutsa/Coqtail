var availableTags = [];

////Function to init the auto complete on input class="autocomplete"
//function initAutoComplete() {
//    var input_selector = 'input[type=text]';
//
//    //For each input selector (in reality there is only one input)
//    $(input_selector).each(function() {
//        var $input = $(this);
//
//        if ($input.hasClass('autocomplete')) 
//        {
//            //Take array of autocomplete word for this input
//            var $array = $input.data('array'), 
//                $inputDiv = $input.closest('.input-field'); // Div to append on
//
//            // Check if "data-array" isn't empty
//            if ($array !== '') 
//            {
//                // Create html element
//                var $html = '<ul class="autocomplete-content hide collection">';
//
//                //Iterate each word in array for initialize the list of autocomplete
//                for (var i = 0; i < $array.length; i++) 
//                {
//                    //Add each li with the name
//                    $html += '<li class="autocomplete-option"><a href="#!" class="collection-item"><span>' + $array[i]['value'] + '</span></a></li>';
//                }
//                
//                //Close list balise
//                $html += '</ul>';
//                //Set ul in body
//                $inputDiv.append($html);
//                //End create html element
//
//                //
//                function highlight(string) 
//                {
//                    $('.autocomplete-content li').each(function() {
//                        var matchStart = $(this).text().toLowerCase().indexOf("" + string.toLowerCase() + ""),
//                            matchEnd = matchStart + string.length - 1,
//                            beforeMatch = $(this).text().slice(0, matchStart),
//                            matchText = $(this).text().slice(matchStart, matchEnd + 1),
//                            afterMatch = $(this).text().slice(matchEnd + 1);
//                        $(this).html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
//                    });
//                }
//
//                //Perform search when push key on keyboard
//                $(document).on('keyup', $input, function() {
//                    //Get value of input
//                    var $val = $input.val().trim(),
//                        $select = $('.autocomplete-content');
//                    
//                    $select.css('width', $input.width());
//
//                    //Check if the input isn't empty
//                    if ($val != '') 
//                    {
//                        $select.children('li').addClass('hide');
//                        $select.children('li').filter(function() {
//                            $select.removeClass('hide'); // Show results
//
//                            //If text needs to highlighted
//                            if ($input.hasClass('highlight-matching')) 
//                            {
//                                highlight($val);
//                            }
//                            var check = true;
//                            for (var i in $val) 
//                            {
//                                if ($val[i].toLowerCase() !== $(this).text().toLowerCase()[i])
//                                    check = false;
//                            };
//                            return check ? $(this).text().toLowerCase().indexOf($val.toLowerCase()) !== -1 : false;
//                        }).removeClass('hide');
//                    } 
//                    else
//                    {
//                        $select.children('li').addClass('hide');
//                    }
//                });
//
//                //Set input value on click
//                $('.autocomplete-option').click(function() {
//
//                    //Add chip with value of input and with class="add green" default
//                    $('#list').prepend('<div class="chip add green">' + $(this).text().trim() + '<i class="close material-icons">close</i></div>');
//
//                    //Delete input value
//                    $input.val('');
//                    
//                    //Hide ul of autocomplete words
//                    $('.autocomplete-option').addClass('hide');
//                });
//            } 
//            else
//            {
//                return false;
//            }
//        }
//    });
//};



$(function initAutoComplete() {
    $("#tags").autocomplete({
        source: availableTags,
        select: function (event, ui) {
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


