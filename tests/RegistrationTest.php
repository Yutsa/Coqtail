<?php

use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    public function testEntryAddedToIndex()
    {
        $indexPath = realpath(dirname(__FILE__) .
            "/../data/") . "/testIndex";

        addEntryToAccountIndex("robert@gmail.com", $indexPath);
        $this->assertTrue(file_exists($indexPath));
        $handle = fopen($indexPath, "r+");
        $mail = explode(":", fgets($handle))[0];
        $this->assertTrue($mail == "robert@gmail.com");
        if (file_exists($indexPath))
            unlink($indexPath);
    }

    public function testStoreUserData()
    {
        $data = "test";
        $dataFilePath = realpath(dirname(__FILE__) .
            "/../data/") . "/testData";

        storeUserData($dataFilePath, $data);
        $this->assertTrue(file_exists($dataFilePath));
        $handle = fopen($dataFilePath, "r+");
        $dataRetrieved = unserialize(fgets($handle));
        $this->assertTrue($dataRetrieved == $data);

        if (file_exists($dataFilePath))
            unlink($dataFilePath);
    }
}

 ?>
