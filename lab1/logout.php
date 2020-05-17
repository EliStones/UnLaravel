<?php
    include_once"User.php";

    //We create a new user instance to access non-static methods in User
    //A second soluiton is declaring the methods as static
    $instance = User::create();
    $instance->logout();

    header("lab1.php");
?>