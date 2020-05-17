<?php
    // Login logic code goes here
    include_once"DBConnector.php";
    include_once"User.php";

    $conn = new DBConnector();
    if (isset($_POST["btn-login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        //Accessing a user object to verify logins, without creating a new user
        $instance = User::create();
        $instance->setUsername($usernmae);
        $instance->setPassword($password);

        //Checking if password is correct
        if ($instance->isPasswordCorrect()) {
            $instance->login();
            $instance->createUserSession();
            //Loginand set session variables
        }
        else {
            header("Location: login.php");
        }

        $conn->closeDatabase();
    }

?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h4>Login</h4>
            <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Placeholder">
                </div>
                <div class="form-group">
                    <input type="submit" name="btn-login" class="btn btn-info">
                </div>
            </form>
        </div>
    </body>
</html>