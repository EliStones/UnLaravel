<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css.map">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css.map">

    <title>Index page</title>
</head>
<body>
    <div class="container">
        <h3>This page communicates with the API using a key passed in headers</h3>
        <h3>It showcases API features as below</h3>
        <hr>
        <h4>Feature 1: Placing an order</h4>
        <form action="" name="order_form" id="order_form" class="form">
            <fieldset>
                <legend>Place order</legend>
                <input class="form-control" type="text" name="meal_name" id="meal_name" required placeholder="Meal Name">
                <input class="form-control" type="number" name="meal_units" id="meal_units" required placeholder="Meal Units">
                <input class="form-control" type="number" name="unit_price" id="unit_price" require placeholder="Unit price">
                <input class="form-control" type="hidden" name="status" id="status" required value="Order placed"> <br><br>

                <button class="btn btn-primary" type="submit">Place Order >></button>
            </fieldset>
        </form>

        <hr>
        <h4>Feature 2. Checking Order Status</h4>
        <hr>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" name="form_order_status" id="form_order_status">
            <fieldset>
                <legend>Check order status = 
                    <span class="" id="display_order_status"></span>
                </legend>
                <input class="form-control" type="number" name="order_id" required placeholder="Enter Order ID">
                <button class="btn btn-primary" type="submit" name="btn_check_status">Check Order Status</button>
            </fieldset>
        </form>

    </div>
    
    <!-- Scripts at bottom of page -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="placeorder.js"></script>

    <!-- Script to check order status -->
    <script>
        $(document).ready(function(){
            // Check order status on button click-ee
    $('#btn_check_status').click(function(){
        alert("Wassuh");
        $('#display_order_status').html("Completed");
        $.ajax({
            url: "//http://localhost/unlaravel/lab%204/api/v1/orders/index.php",
            type: "post",
            data: {
                order_id:order_id
            },

            headers:{
                'Authorization':'Basic {API key here}',
            },

            success: function(data){
                alert(data['message']);
                $('#display_order_status').Html("Completed");
            },

            error: function(data){
                alert("An error occured");
            }
        })
    })
        })
    </script>
</body>
</html>