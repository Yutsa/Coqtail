var stateData = [];

function initAutoComplete() {
    var input_selector = 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], textarea';

    /*************************
        * Auto complete plugin  *
        *************************/

    $(input_selector).each(function() {
        var $input = $(this);

        if ($input.hasClass('autocomplete')) {
            var $array = $input.data('array'), 
                $inputDiv = $input.closest('.input-field'); // Div to append on
            // Check if "data-array" isn't empty
            if ($array !== '') {
                // Create html element
                var $html = '<ul class="autocomplete-content hide collection">';

                for (var i = 0; i < $array.length; i++) {
                    // If path and class aren't empty add image to auto complete else create normal element
                    if ($array[i]['path'] !== '' && $array[i]['path'] !== undefined && $array[i]['path'] !== null && $array[i]['class'] !== undefined && $array[i]['class'] !== '') 
                    {
                        //<a href="#!" class="collection-item">Alvin</a>
                        $html += '<li class="autocomplete-option"><a href="#!" class="collection-item"><img src="' + $array[i]['path'] + '" class="' + $array[i]['class'] + '"><span>' + $array[i]['value'] + '</span></a></li>';
                    }
                    else 
                    {
                        $html += '<li class="autocomplete-option"><a href="#!" class="collection-item"><span>' + $array[i]['value'] + '</span></a></li>';
                    }
                }

                $html += '</ul>';
                $inputDiv.append($html); // Set ul in body
                // End create html element

                function highlight(string) {
                    $('.autocomplete-content li').each(function() {
                        var matchStart = $(this).text().toLowerCase().indexOf("" + string.toLowerCase() + ""),
                            matchEnd = matchStart + string.length - 1,
                            beforeMatch = $(this).text().slice(0, matchStart),
                            matchText = $(this).text().slice(matchStart, matchEnd + 1),
                            afterMatch = $(this).text().slice(matchEnd + 1);
                        $(this).html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
                    });
                }

                // Perform search
                $(document).on('keyup', $input, function() {
                    var $val = $input.val().trim(),
                        $select = $('.autocomplete-content');
                    // Check if the input isn't empty
                    $select.css('width',$input.width());

                    if ($val != '') {
                        $select.children('li').addClass('hide');
                        $select.children('li').filter(function() {
                            $select.removeClass('hide'); // Show results

                            // If text needs to highlighted
                            if ($input.hasClass('highlight-matching')) {
                                highlight($val);
                            }
                            var check = true;
                            for (var i in $val) {
                                if ($val[i].toLowerCase() !== $(this).text().toLowerCase()[i])
                                    check = false;
                            };
                            return check ? $(this).text().toLowerCase().indexOf($val.toLowerCase()) !== -1 : false;
                        }).removeClass('hide');
                    } else {
                        $select.children('li').addClass('hide');
                    }
                });

                // Set input value
                $('.autocomplete-option').click(function() {

                    $('#list').prepend('<div class="chip add green">' + $(this).text().trim() + '<i class="close material-icons">close</i></div>');

                    $input.val('');

                    $('.autocomplete-option').addClass('hide');
                });
            } 
            else
            {
                return false;
            }
        }
    });
};

//Event, when click on chip ingredient search
//Inverse class (add to remove or remove to add)
//Use onFirst because it had to be execute before the search
$('#list').onFirst('click', 'div.chip', function() {
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
            stateData.push({value : data[0][i]});
        }

        //Add js array to #autocompleteState element (search bar)
        $('#autocompleteState').data('array', stateData);

    }).done(function() {
        //When it's done, init the auto completion
        initAutoComplete();
    });
});