<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header('login.php');
    }
?>

<html>
    <head>
        <title>Users Page</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid">
            <h1>Welcome Person!</h1>
            <h3>This is a private protected page.<br>Only users allowed here</h3>
            <button href="logout.php" class="btn btn-danger"></button>
        </div>
    </body>
</html>