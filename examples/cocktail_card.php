<?php
$cocktail_name = 'Black Velvet';
$cocktail_description = 'Un cocktail trop cool.';
$cocktail_image = 'static/img/Black_velvet.jpg';

function displayCocktail($cocktail_name, $cocktail_description, $cocktail_image)
{
    if (!empty($cocktail_name) && !empty($cocktail_description) &&
    !empty($cocktail_image))
    {
?>
        <div class='row'>
            <div class='col s6 offset-s3'>
                <div class='card'>
                    <div class='card-image'>
                        <img src='<?= $cocktail_image ?>' alt='black-velvet' />
                        <span class='card-title black-text'>
                            <?= $cocktail_name ?></span>
                    </div>
                    <div class='card-content'>
                        <p>
                            <?= $cocktail_description ?>
                        </p>
                    </div>
                    <div class='card-action'>
                        <a href='#'>Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>
