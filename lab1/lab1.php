<?php
    include_once('User.php');
    include_once('DBConnector.php');
?>

<html>
    <head>
        <title>PHP LaB 1</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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

            <div class="col-md-5">
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
            </div>
        </div>
        <div class="row w-75 m-auto">
            <?php
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