<?php

include(realpath(dirname(__FILE__) .
        "/../core/register_user.php"));
include(realpath(dirname(__FILE__) .
    "/../core/connect_user.php"));
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    public function testFindUser()
    {
        $file = realpath(dirname(__FILE__) . "/../data/") .
            "/indexTest";
        if (file_exists($file))
            unlink($file);
        $mail = "edouard@gmail.com";
        addEntryToAccountIndex($mail, $file);
        $this->assertTrue(checkIfUserExists($mail, $file));
    }

    public function testDontFindUser()
    {
        $file = realpath(dirname(__FILE__) . "/../data/") .
        "/indexTest";
        if (file_exists($file))
            unlink($file);
        $mail = "edouard@gmail.com";
        addEntryToAccountIndex($mail, $file);
        $this->assertFalse(checkIfUserExists("prout", $file));
    }
}

 ?>
