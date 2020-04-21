<?php
    include_once('User.php');
    include_once('DBConnector.php');

    if (isset($_POST['btn-save'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['user_city'];

        //CReating a new user ObjEct
        $user = new User($first_name, $last_name, $city);
        $res = $user -> save(); //$res means result

        //Receive results from save function and store in boolean variable $res. 
        //Depending on the value of $res we display true or false
        if ($res) {
            echo "Operation Successful";
        }
        else {
            echo "Error adding user.";
        };
    }

    if (isset($_POST['btn-view-saves'])) {
        User::readAll();
    }
?>

<html>
    <head>
        <title>PHP LaB 1</title>
    </head>

    <body>
        <h2 align="center">LAB 1</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <table align="center">
                
                <tr>
                    <td><input type="text" required name="first_name" placeholder="First Name"></td>
                </tr>
                <tr>
                    <td><input type="text" required name="last_name" placeholder="Last Name"></td>
                </tr>
                <tr>
                    <td><input type="text" required name="user_city" placeholder="City"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="btn-save" value="SAVE"></td>
                </tr>
            </table>
        </form>
        <form action="" method="post">
            <input type="submit" name="btn-view-saves" value="View saved Items">
        </form>
    </body>
</html>