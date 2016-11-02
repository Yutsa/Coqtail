<?php

use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    public function testGetCocktailByName()
    {
        $cocktail = getCocktailByName("Aperol Spritz : cocktail italien pétillant", $Recettes);
        $this->assertTrue($cocktail["preparation"] == "Préparer la quantité de cocktail souhaitée en respectant les proportions ! Garnir de glaçons et d\'un morceau d\'orange (sanguine si possible). Santé !");
    }
}

 ?>
