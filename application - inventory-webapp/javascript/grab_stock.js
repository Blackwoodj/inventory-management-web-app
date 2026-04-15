// Jonathan Blackwood 
// HND Software Development 
// Grab stock AJAX request javascript page
// 23/05/2023
$(document).ready(function() {
    $.ajax({ // Start AJAX request
        url: 'includes/grab_stock.inc.php', // Specify location to send request
        type: 'GET', // Get request
        success: function(data) {
            $('#stockTable').append(data); // Sends data to stock table on success
        },
        error: function() {
            alert('Error occurred while getting stock data.'); // Displays error when occurs
        }
    });
});
