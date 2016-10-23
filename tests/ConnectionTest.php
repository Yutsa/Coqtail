<?php

use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    public function testGetUsersDataFile()
    {
        $file = realpath(dirname(__FILE__) . "/../data/") .
            "/indexTest";
        $mail = "edouard@gmail.com";
        addEntryToAccountIndex($mail, $file);
        $result = getUsersDataFile($mail, $file);
        $expectedResult = "../data/" . $mail;
        $this->assertTrue($result == $expectedResult);
        if (file_exists($file))
            unlink($file);
    }

    public function testCheckPassword()
    {
        $dataFilePath = realpath(dirname(__FILE__) . "/../data/") . "/testData";
        $password = "foobar";
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $mail = "edouard@gmail.com";
        $user = array(
            "email" => $mail,
            "password" => $hashedPassword,
            "basket" => array()
        );
        storeUserData($dataFilePath, $user);
        $this->assertTrue(checkPassword($mail, $password, $dataFilePath));
        if (file_exists($dataFilePath))
            unlink($dataFilePath);

    }
}

 ?>
