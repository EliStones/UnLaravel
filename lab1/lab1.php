<?php
    include_once('User.php');
    include_once('DBConnector.php');
    include_once('uploads/FileUploader.php');
?>

<html>
    <head>
        <title>PHP LaB 1</title>
        <!-- Stylesheets -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="validate.css">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
        <script type="text/javascript"  src="validate.js"></script>
        <script src="timezone.js" type="text/javascript"></script>
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
                <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()"
                action="<?php echo $_SERVER['PHP_SELF']?>"  name="user_details" id="user_details">
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
                            <td>Profile image: <input type="file" name="fileToUpload" id="fileToUpload"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="username" placeholder="Username"></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" placeholder="Password"></td>
                        </tr><br>
                        <!-- Hidden input -->
                        <input type="hidden" name="utc_timestamp" id="utc_timestamp">
                        <input type="hidden" name="time_zone_offset" id="time_zone_offset">
                        <tr>
                            <td><input type="submit" name="btn-save" value="SAVE"></td>
                        </tr>
                        <hr>
                        <tr>
                            <td><a href="login.php" class="btn btn-primary align-content-center">Login</a></td>
                        </tr>
                    </table>
                </form>

                <!-- Test for image submission -->
                <!-- <form action="<?//php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                    Profile image: <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" name="save-dp">
                </form> -->

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

                    $profile_image = null;

                    $timestamp = $_POST["utc_timestamp"];
                    $offset = $_POST["time_zone_offset"];
            
                    //CReating a new user ObjEct
                    $user = new User($first_name, $last_name, $city, $username, $password, $profile_image, $timestamp, $offset);

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

                    //If no image added, we go ahead to save user
                    if ($_FILES["fileToUpload"]["error"] != 4) {
                        $fileUpload = new FileUploader();
                        $uploadedImage = $fileUpload->uploadFile();
                        if (!$uploadedImage) {
                            echo "<br>Error uploading image.";
                            echo $_SESSION["upload-errors"];
                            unset($_SESSION["upload-errors"]);
                            //If error with uploading image we end
                            die();
                        }
                        
                        //Add profile image to user object
                        $user->setProfileImage($fileUpload->getOriginalName());
                    }

                    //Save data to DB
                    $res = $user -> save(); //$res means result
            
                    //Receive results from save function and store in boolean variable $res. 
                    //Depending on the value of $res we display true or false
                    if ($res) {
                        echo "Operation Successful";
                    }
                    else {
                        echo "<br>Error adding user.";
                    };
                }

                // test image submission
                // if(isset($_POST["save-dp"])){
                //     print_r($_FILES["fileToUpload"]);
                //     $fileUpload = new FileUploader();
                //     $fileUpload->uploadFile();
                // }
            
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