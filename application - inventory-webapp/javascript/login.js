// Jonathan Blackwood 
// HND Software Development 
// Log in AJAX Javascript page
// 23/05/2023 
document.getElementById("loginForm").addEventListener("submit", function(event) { // Adds event listener to trigger on form submission
    event.preventDefault(); // Prevent form submission from reloading page

    var loginField = document.getElementById("loginField").value; // Get value of loginField and store
    var password = document.getElementById("password").value; // Get value of password and store

    var xhr = new XMLHttpRequest(); // Create new xmlh request
    xhr.open("POST", "login_ajax.php", true); // Initialise AJAX request with post method, true set to mean asynchronous
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Handle the response from the server
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) { // Checking ready state is equal to done state, meaning request is complete
            if (xhr.status === 200) { // 200 response means successful
                // Parse the JSON response
                var response = JSON.parse(xhr.responseText);

                // Check if login was successful
                if (response.success) {
                    // Redirect to rota.php on successful login
                    window.location.href = "rota.php";
                } else {
                    // Display login error message
                    document.getElementById("loginError").textContent = response.message;
                }
            } else {
                // Handle errors
                console.error("Login request failed. Status: " + xhr.status);
            }
        }
    };

    // Prepare the request
    var data = "loginField=" + encodeURIComponent(loginField) + "&password=" + encodeURIComponent(password);
    xhr.send(data); // Send the request
});
