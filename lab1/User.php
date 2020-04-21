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
                "<table align='center'>".
                "<tr>"."<th>User_id<th>"."<th>First name</th>"."<th>Last name</th>"."<th>City name</th>"."</tr>"
            );

            $query = "SELECT * FROM user";
            if($res = mysqli_query($con->conn, $query)){// If we get a result from running the query then...
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

        public function readUnique()
        {
               
        }

        public function search()
        {
            # code...
        }

        public function update()
        {
            # code...
        }

        public function removeOne()
        {
            # code...
        }

        public function removeAll()
        {
            # code...
        }

    }
?>