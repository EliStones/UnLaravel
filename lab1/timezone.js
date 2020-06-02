$(document).ready(function () {
    var offset = new Date().getTimezoneOffset();

    var timestamp = new Date().getTime(); //Get values in milliseconds

    var date = new Date().toString();

    var utc_timestamp = timestamp + (60000 * offset);

    $('#time_zone_offset').val(offset);

    $('#utc_timestamp').val(utc_timestamp);

    //In lines 11 and 12, the values of offset and timestamp are set
    //to items with corresponding IDs in the HTML markup

})