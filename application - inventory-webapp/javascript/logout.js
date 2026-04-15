// Jonathan Blackwood 
// HND Software Development 
// Log out AJAX Javascript page
// 23/05/2023 
document.getElementById("logoutButton").addEventListener("click", function() { // Adds event listener to trigger for element logoutButton
    var xhr = new XMLHttpRequest(); // Create new xmlh request
    xhr.open("GET", "logout.php?logout", true); // Initialise the GET request to logout.php, true set to mean asynchronous

    // Handle the response from the server
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {// Checking ready state is equal to done state, meaning request is complete
            if (xhr.status === 200) // 200 Response stands for successful
            {
                
                var response = JSON.parse(xhr.responseText); // Parse the JSON response

                // Check if logout was successful
                if (response.success) {
                    // Redirect to the login page on successful logout
                    window.location.href = "index.php";
                } else {
                    // Handle logout error
                    console.error("Logout request failed. Error: " + response.message);
                }
            } else {
                // Handle request error
                console.error("Logout request failed. Status: " + xhr.status);
            }
        }
    };
    xhr.send();// Send the request
});
