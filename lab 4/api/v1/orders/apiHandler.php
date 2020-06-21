<?php

    class ApiHandler{
        private $meal_name;
        private $meal_units;
        private $unit_price;
        private $status;
        private $user_api_key;

        // Getters and setters
        public function getMealName()
        {
            return $this->meal_name;
        }

        public function getMealUnits()
        {
            return $this->meal_units;
        }

        public function setMealName($meal_name)
        {
            $this->meal_name = $meal_name;
        }

        public function setMealUnits($meal_units)
        {
            $this->meal_units = $meal_units;
        }

        public function getUnitPrice()
        {
            return $this->unit_price;
        }

        public function setUnitPrice($unit_price)
        {
            $this->unit_price = $unit_price;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }

        public function getUserApiKey()
        {
            return $this->user_api_key;
        }

        public function setUserApiKey($user_api_key)
        {
            $this->user_api_key = $user_api_key;
        }

        public function createOrder()
        {
            // Save the order to DB
            $con = new DBConnector();
            $query = "INSERT into Orders(order_name, units, unit_price, order_status) 
                VALUES('$this->meal_name','$this->meal_units','$this->unit_price','$this->status')";
            $res = mysqli_query($con->conn, $query) or die("Error: "+mysqli_error($con->conn));
        }

        public function checkOrderStatus($id)
        {
            $con = new DBConnector();

            $query = "SELECT order_status FROM orders WHERE id = '$id'";
            $res = mysqli_query($con->conn, $query) or die("Error:" + mysqli_error($con->conn));
        }

        public function fetchAllOrders()
        {
            // Get all orders and display in a table
            $con = new DBConnector();

            $query = "SELECT * FROM orders";
            $res = mysqli_query($con->conn, $query) or die("Error:" + mysqli_error($con->conn));

            while($row = $res->fetch_row()){
                echo $row[0], $row[1], $row[2], $row[3], "<br>";
            }
        }

        public function checkApiKey()
        {   
            return true;
        }

        public function checkContentType()
        {
            
        }

        
    }

?>