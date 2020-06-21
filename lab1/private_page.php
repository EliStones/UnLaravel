<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header('login.php');
    }
?>

<html>
    <head>
        <title>Users Page</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css.map">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css.map">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid">
            <h3>Welcome Person!</h3>
            <h4>This is a private protected page.<br>Only users allowed here</h4>
            <a href="logout.php"  class="btn btn-danger">Logout</a>
            <hr>
            <h5>Here we will create an API that will allow users to order from external systems</h5>
            <hr>
            <h5>Below is a feature to allow users to generate an API key. Click now to get an API key</h5>

            <button class="btn btn-primary" id="api-key-btn">Generate API Key</button> <br> <br>

            <div class="jumbotron">
                
                <p><strong>Your API Key: </strong>Note that if your API key is already in use by already running applications, generating a 
                    new key will stop the applications from functioning
                </p> 
                
                <textarea name="api_key" id="api_key" cols="100" rows="2"><?php echo "fetchUserApiKey"; ?></textarea>

                <hr>
                <h3>Service description</h3>
                <p>We have a service or API that allows external applications to order food and also pulls all 
                    order status using order id.
                </p>
            </div>
        </div>

        <?php
            //Generate API keys
            include_once "DBConnector.php";
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('HTTP 1.0 403 Forbidden');
                echo "Access forbidden";
            }
            else{
                $api_key = null;
                $api_key = generate_api_key(64);
                header('Content-type: application/json');

                echo generateResponse($api_key);
            }

            //Below we come up with a key using our parameters
            function generate_api_key($str_length)
            {
                $charset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVXWYZ";

                //Get some bytes for randomization
                $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1 );

                $repl = unpack("C2", $bytes);

                $first = $charset[$repl[1]%62];
                $second = $charset[$repl[2]%62];

                return strtr(substr(base64_encode($bytes), 0, $str_length), '+/', "$first$second");

            };

            function saveApiKey()
            {
                // Save API key to DB
                return true;
            }
        
            function generateResponse($api_key)
            {
                if (saveApiKey()) {
                    $res = ['success' => 1,'message' => $api_key];
                }
                else {
                    $res =['success' => 0, 'message' => 'Something went wrong. Please regenerate the API key'];
                }

                return json_encode($res);
            }

            function fetchUserApiKey()
            {
                // Get user API key from DB
                $username = $_SESSION["username"];

                $con = new DBConnector();
                $query = "SELECT api_key FROM Users WHERE username = '$username'";
                $res = mysqli_query($con->conn, $query) or die("Error: "+mysqli_error($con->conn));

                return $res;
            }
        ?>

    </body>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>


        <script src="validate.js" type="text/javascript"></script>
        <script src="lab4/apikey.js" type="text/javascript"></script>
        <link rel="stylesheet" href="validate.css">
</html>