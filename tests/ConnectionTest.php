<?php

include("../core/register_user.php");
include("../core/connect_user.php");
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    public function testFindUser()
    {
        $file = "../data/testIndex";
        unlink($file);
        $mail = "edouard@gmail.com";
        addEntryToAccountIndex($mail, $file);
        $this->assertTrue(checkIfUserExists($mail, $file));
    }

    public function testDontFindUser()
    {
        $file = "../data/testIndex";
        unlink($file);
        $mail = "edouard@gmail.com";
        addEntryToAccountIndex($mail, $file);
        $this->assertFalse(checkIfUserExists("prout", $file));
    }
}

 ?>
