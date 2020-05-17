<?php
    include_once"User.php";

    //Logged out
    User::logout();

    header("lab1.php");
?>