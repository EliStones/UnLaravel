<?php

    //Class file for a User object

    include("Crud.php");
    include("Authenticator.php");
    include_once('DBConnector.php');

    class User implements Crud,Authenticator{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;

        private $username;
        private $password;
        private $profile_image;

        private $utc_timezone;
        private $offset;

        function __construct($first_name, $last_name, $city_name, $username, $password, $profile_image, $utc_timezone, $offset)
        {
            $this->city_name = $city_name;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->username = $username;
            $this->password = $password;
            $this->profile_image = $profile_image;
            $this->utc_timezone = $utc_timezone;
            $this->offset = $offset;
        }

        //We create new instance of self(), the user for authentication
        //Error with create() requires constructor
        // public static function create()
        // {
        //     $instance  = new self();
        //     return $instance;
        // }

        public function setUserId($user_id)
        {
            $this->user_id = $user_id;
        }

        public function getUserId()
        {
            return $this->user_id;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function setUsername($username)
        {
            $this->username = $username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {   
            $this->password = $password;
        }

        public function setProfileImage($profile_image)
        {
            $this->profile_image = $profile_image;
        }

        public function setOffset($offset)
        {
            $this->offset = $offset;
        }

        public function getOffset()
        {
            return $this->offset;
        }

        public function setUtcTimezone($utc_timezone)
        {
            $this->utc_timezone = $utc_timezone;
        }

        public function getutc_timezone()
        {
            return $this->utc_timezone;
        }

        // End of getters and setters

        public function isUserExist()
        {
            $con = new DBConnector();//DB connection opened to enter data

            $query = "SELECT * FROM user";
            $res = mysqli_query($con->conn, $query);
            while ($row = mysqli_fetch_assoc($res)) {
                if ($row["username"] == $this->username) {
                    $_SESSION["form-errors"] = "This username is taken";
                    return true;
                }      
            }

            return false;

            $con->closeDatabase();//DB connection closed
        }

        public function save()
        {   
            $con = new DBConnector();//DB connection opened to enter data
            $fn = $this->first_name;
            $ln = $this->last_name;
            $cn = $this->city_name;
            $username = $this->username;
            $profile_image = $this->profile_image;

            $utc = $this->utc_timezone;
            $offset = $this->offset;

            echo $utc;
            echo $offset;

            //Hashes the Current users password
            $this->hashPassword();

            $password = $this->password;
            $query = "INSERT INTO user(first_name, last_name, user_city, username, password, profile_image, timestamp, offset) 
            VALUES('$fn','$ln','$cn', '$username', '$password', '$profile_image','$utc', '$offset')";

            $res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn));
            return $res;

            echo $profile_image;


            $con->closeDatabase();//DB connection closed
        }

        public static function readAll()
        {
            $con = new DBConnector();//DB connection opened to enter data

            print(
                "<table class=\"table table-responsive\">".
                "<tr>"."<th>User_id<th>"."<th>First name</th>"."<th>Last name</th>"."<th>City name</th>"."<th><th>"."</tr>"
            );

            $query = "SELECT * FROM user";
            if($res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn))){// If we get a result from running the query then...
                while ($row = $res->fetch_row()) {
                    print(
                        "<tr>"."<td>".$row[0]."<td>"."<td>".$row[1]."</td>"."<td>".$row[2]."</td>"."<td>".$row[3]."</td>"."</tr>"
                    );
                }
                print(
                "</table>");
            }
            else{
                echo "No records to show";
            };

            $con->closeDatabase();//DB connection closed

        }

        public static function readUnique($user_id)
        {
            $con = new DBConnector();//DB connection opened to enter data

            //Printing the table head
            print(
                "<table class=\"table table-responsive\">".
                "<tr>"."<th>User_id<th>"."<th>First name</th>"."<th>Last name</th>"."<th>City name</th>"."<th><th>"."</tr>"
            );

            $query = "SELECT * FROM user WHERE id = ".$user_id;
            if($res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn))){// If we get a result from running the query then...
                while ($row = $res->fetch_row()) {
                    print(
                        "<tr>"."<td>".$row[0]."<td>"."<td>".$row[1]."</td>"."<td>".$row[2]."</td>"."<td>".$row[3]."</td>"."</tr>"
                    );
                }
                print(
                "</table>");
            }
            else{
                echo "<td>No records to show</>";
            };

            $con->closeDatabase();//DB connection closed
        }

        public static function search($searchBy, $searchTerm)
        {
            $con = new DBConnector();//DB connection opened to enter data

            //Printing the table head
            print(
                "<table class=\"table table-responsive\">".
                "<tr>"."<th>User_id<th>"."<th>First name</th>"."<th>Last name</th>"."<th>City name</th>"."<th><th>"."</tr>"
            );

            $query = "SELECT * FROM user WHERE ".$searchBy."='".$searchTerm."'";
            if($res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn))){// If we get a result from running the query then...
                while ($row = $res->fetch_row()) {
                    print(
                        "<tr>"."<td>".$row[0]."<td>"."<td>".$row[1]."</td>"."<td>".$row[2]."</td>"."<td>".$row[3]."</td>"."</tr>"
                    );
                }
                print(
                "</table>");
            }
            else{
                echo "No records to show";
            };

            $con->closeDatabase();//DB connection closed
        }

        public static function update($field_name, $id, $new_value)
        {
            $con = new DBConnector();//DB connection opened to enter data

            $query = "UPDATE user SET ".$field_name."='".$new_value."' WHERE id ='".$id."'";
            if($res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn))){// If we get a result from running the query then...
                echo "Record updated successfully successfully.";
            }
            else{
                echo "No records to show";
            };

            $con->closeDatabase();//DB connection closed
        }

        public static function removeOne($id)
        {
            $con = new DBConnector();//DB connection opened to enter data

            $query = "DELETE FROM user WHERE id = '".$id."'";
            if($res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn))){// If we get a result from running the query then...
                echo "Record deleted successfully.";
            }
            else{
                echo "No records to show";
            };

            $con->closeDatabase();//DB connection closed
        }

        public static function removeAll()
        {
            $con = new DBConnector();//DB connection opened to enter data

            $query = "DELETE FROM user";
            if($res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn))){// If we get a result from running the query then...
                echo "Deleted all records.";
            }
            else{
                echo "No records to show";
            };

            $con->closeDatabase();//DB connection closed
        }

        public function validateForm()
        {
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city_name = $this->city_name;

            if ($fn == "" || $ln == "" || $city_name == "") {
                return false;
            }
            return true;
        }

        public function createFormErrorSessions()
        {
            $_SESSION["form-errors"] = "Kindly fill out all fields.";
        }

        public function hashPassword()
        {
            //Default password hash is Bcrypt
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        public static function isPasswordCorrect($username, $password)
        {
            $con = new DBConnector();
            $foundUser = false;
            $res = mysqli_query($con, "SELECT * FROM user");

            while ($row = mysqli_fetch_assoc($res)) {
                if (password_verify($password, $row["password"]) && $username == $row["username"]) {
                    $found = true;
                }
            }

            $con->closeDatabase();
            return $found;
        }

        // Login
        public static function login($username, $password)
        {
            if (User::isPasswordCorrect($username, $password)) {
                $_SESSION["username"] = $this->getUsername();
                //Page to redirect after login
                header('Location: private_page.php');
            }
        }

        public function createUserSession()
        {
            //Implemented in login function
            //$_SESSION["username"] = $this->getUsername();
        }

        public static function logout()
        {
            unset($_SESSION["username"]);
            session_destroy();
            header("Location: lab1.php");
        }
    }
?>