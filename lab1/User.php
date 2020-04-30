<?php

    include("Crud.php");
    include_once('DBConnector.php');

    class User implements Crud{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;

        function __construct($first_name, $last_name, $city_name)
        {
            $this->city_name = $city_name;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
        }

        public function setUserId($user_id)
        {
            $this->user_id = $user_id;
        }

        public function getUserId()
        {
            return $this->user_id;
        }

        public function save()
        {   
            $con = new DBConnector();//DB connection opened to enter data
            $fn = $this->first_name;
            $ln = $this->last_name;
            $cn = $this->city_name;
            $query = "INSERT INTO user(first_name, last_name, user_city) VALUES('$fn','$ln','$cn')";

            $res = mysqli_query($con->conn, $query) or die("Error: ".mysqli_error($con->conn));
            return $res;

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

    }
?>