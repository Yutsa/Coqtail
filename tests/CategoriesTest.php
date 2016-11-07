<?php

use PHPUnit\Framework\TestCase;

class CategoriesTest extends TestCase
{
    public function testGetSubcategory()
    {
        global $Hierarchie;
        $categorie = "Boisson gazeuse non alcoolisée";
        $res = getSubcategory($categorie, $Hierarchie);
        $this->assertTrue($res == $Hierarchie[$categorie]["sous-categorie"]);
    }
}

 ?>
