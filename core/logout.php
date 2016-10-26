<?php
    session_start();
    if (isset($_SESSION["userDataFileName"]))
    {
        unset($_SESSION["userDataFileName"]);
    }
    header("Location: ../index.php");
 ?>
