<?php
    include_once('User.php');
    include_once('DBConnector.php');
?>

<html>
    <head>
        <title>PHP LaB 1</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript"  src="validate.js"></script>
        <link rel="stylesheet" href="validate.css">
    </head>

    <body>
        <div class="row w-100">
            <div class="col-md-5">
                <!-- View saved items form -->
            <form action="" method="post">
                <input type="submit" name="btn-view-saves" value="View saved Items">
            </form>
            <!-- Search by ID form -->
            <form action="" method="post">
                <label for="view-by-id">Get user by id. ID: </label>
                <input type="number" name="user-id">
                <input type="submit" name="btn-view-by-id" value="Submit ID">
            </form>
            <!-- Search form -->
            <form action="" method="post">
                <label for="search-by">Search by: </label>
                <select name="search-by">
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="user_city">City Name</option>
                </select>
                <label for="search-term">Enter search: </label>
                <input type="text" name="search-term">
                <input type="submit" name="btn-search">
            </form>
            <!-- Update form -->
            <form action="" method="post">
                <label for="user-id">Enter user id:</label>
                <input type="number" name="user-id">
                <label for="field-name">Select field:</label>
                <select name="field-name">
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="user_city">City</option>
                </select>
                <label for="new-value">Enter new value</label>
                <input type="text" name="new-value">
                <input type="submit" name="btn-update">
            </form>
            <!-- Delete form -->
            <form action="" method="post">
                <label for="user-id">Enter ID to delete: </label>
                <input type="number" name="user-id">
                <input type="submit" name="btn-delete-one">
            </form>
            <!-- Delete All form -->
            <form action="" method="POST">
                <input type="submit" name="btn-delete-all" value="Delete all records">
            </form>
            </div>

            <!-- Create user form -->
            <div class="col-md-5">
                <h2 align="center">LAB 1</h2>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()"
                action="<?$_SERVER['PHP_SELF']?>"  name="user_details" id="user_details">
                    <table align="center">

                        <tr>
                            <div id="form-errors">
                                <?php
                                    session_start();
                                    if (!empty($_SESSION["form-errors"])) {
                                        echo " ".$_SESSION["form-errors"];
                                        unset($_SESSION["form-errors"]);
                                    }    
                                ?>
                            </div>
                        </tr>
                        
                        <tr>
                            <td><input type="text" name="first_name" placeholder="First Name"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="last_name" placeholder="Last Name"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="user_city" placeholder="City"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="username" placeholder="Username"></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" placeholder="Password"></td>
                        </tr><br>
                        <tr>
                            <td><input type="submit" name="btn-save" value="SAVE"></td>
                        </tr>
                        <hr>
                        <tr>
                            <td><a href="login.php" class="btn btn-primary align-content-center">Login</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="row w-75 m-auto">
            <?php
                if (isset($_POST['btn-save'])) {
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $city = $_POST['user_city'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
            
                    //CReating a new user ObjEct
                    $user = new User($first_name, $last_name, $city, $username, $password);

                    //Server side validation for user details
                    if (!$user->validateForm()) {
                        $user->createFormErrorSessions();
                        //header("Refresh: 0");
                        die();
                    }

                    //Check if username already exists
                    if($user->isUserExist()){
                        echo $_SESSION["form-errors"];
                        unset($_SESSION["form-errors"]);
                        die();
                    }

                    //Save data to DB
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
                }elseif(isset($_POST['btn-view-by-id'])){
                    User::readUnique($_POST['user-id']);
                }elseif (isset($_POST['btn-search'])) {
                    User::search($_POST['search-by'], $_POST['search-term']);
                }elseif (isset($_POST['btn-delete-one'])){
                    User::removeOne($_POST['user-id']);
                }elseif (isset($_POST['btn-delete-all'])) {
                    User::removeAll();
                }elseif (isset($_POST['btn-update'])) {
                    User::update($_POST['field-name'],$_POST['user-id'],$_POST['new-value']);
                }
            ?>
        </div>
    </body>

</html>