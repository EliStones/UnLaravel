$(document).ready(function (Event) {
    Event.preventDefault();

    // Retrieve value of from fields using id's
    var mealName = $('#meal_name').val();
    var meal_units = $('#meal_units').val();
    var unit_price = $('#unit_price').val();
    var order_status = $('#status').val();

    // Using Ajax to send a PHP request that passes Data to API
    $.ajax({
        url:"http://http://localhost/unlaravel/lab%204/api/v1/orders/index.php",
        type: "post",
        // This data below is bundled into a POST request
        // The structure is in key-value pairs
        data: {
            meal_name:meal_name,
            meal_units:meal_units,
            unit_price:unit_price,
            status:status
        },

        // Auth headers e.g. CSRF for Laravel
        // The headers set here are grabbed on API side
        // And API key is checked for validity
        headers: {
            'Authorization':'Basic {API Key here}'
        },

        // OnSuccess Function
        success: function (data) {
            alert(data['message']);
        },
        // OnError Function
        error: function () {
            alert('An error occured');
        }
    });
    
});