<?php
    /*
        This file is named as index.php so that it is opened when
        we hit url '..api/v1/orders' without selecting a particular file.

        In any case if we rename this file, then we will have to reference this
        index.php file directly using url 'api/v1/orders/[new_name].php'. It will
        have the same effect as using url 'api/v1/orders' with index.php file
    */
    include('apiHandler.php');
    include_once('../../../../lab1/DBConnector.php');

    $api = new ApiHandler();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Evaluate the API key
        $api_key_valid = true;

        $headers = apache_request_headers();
        printf($headers);
        $header_api_key = $headers['Authorization'];
        $api->setUserApiKey($header_api_key);

        $api_key_valid = $api->checkApiKey();

        // What to do if API key is correct
        if ($api_key_valid) {
            // Create an order
            $meal_name = $_POST["food_name"];
            $meal_units = $_POST["meal_units"];
            $unit_price = $_POST["unit_price"];
            $order_status = $_POST["order_status"];

            $con = new DBConnector();

            // We can restructure the API to create the info below
            // using a constructor
            $api->setMealName($meal_name);
            $api->setMealUnits($meal_units);
            $api->setUnitPrice($unit_price);
            $api->setStatus($order_status);

            $res = $api->createOrder();

            // Returning the response
            if ($res) {
                $response_array = [
                    'success' => 0,
                    'message' => 'Order has been placed'
                ];
                // Adding http header
                header('Content-type: application/json');
                // Printing the array
                echo json_encode($response_array);
            }
        }
        // If API key is not correct
        else{
            $response_array = [
                'success' => 0,
                'message' => 'Wrong API key'
            ];
            header('Content-type: application/json');
            echo json_encode($response_array);
        }

    }
    // If we have a different method e.g. GET
    else{
        echo "Sorry an error seems to have occurred.";
    }
?>