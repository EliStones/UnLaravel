//Function to valideate a php form

function validateForm() {
    var fname = document.forms["user_details"]["first_name"].value;
    var lname = document.forms["user_details"]["last_name"].value;
    var usercity = document.forms["user_details"]["user_city"].value;

    if(fname == null || lname == "" || usercity == ""){
        alert("Kindly fill out all fields")
        return false;
    }
    return true;
}