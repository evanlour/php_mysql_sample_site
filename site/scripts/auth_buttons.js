// auth_buttons.js

document.addEventListener("DOMContentLoaded", function () {
    // Select all buttons with the class 'auth-button'
    const buttons = document.querySelectorAll('.button');

    buttons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();  // Prevent default button action

            // Get the token from localStorage
            const token = localStorage.getItem("authToken");

            if (!token) {
                alert("You must be logged in!");
                window.location.href = "login.php";  // Redirect to login if no token exists
                return;  // Exit if no token is found
            }

            // Prepare the form data to send token
            const formData = new FormData();
            formData.append('token', token);

            // Send the token to auth_check.php for validation
            fetch('scripts/auth_check.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Token is valid, proceed with the button's functionality
                    executeButtonAction(button);
                } else {
                    // Token validation failed
                    alert("Authentication failed: " + data.message);
                    window.location.href = 'login.php';  // Redirect to login if validation fails
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            });
        });
    });
});
