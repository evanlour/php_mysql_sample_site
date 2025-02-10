const icon = document.getElementById('passwordIcon');
let passwordVis = document.getElementById('passwordLabel');

/* Event fired when <i> is clicked */
icon.addEventListener('click', function() {
  if(passwordVis.type === "password") {
    passwordVis.type = "text";
    icon.classList.add("bi-eye-slash-fill");
    icon.classList.remove("bi-eye");
  }
  else {
    passwordVis.type = "password";
    icon.classList.add("bi-eye");
    icon.classList.remove("bi-eye-slash-fill");
  }
});

let loginButton = document.getElementById("loginButton");
loginButton.addEventListener('click', function(event){
  event.preventDefault();
  const email = document.getElementById("emailLabel").value;
  const password = document.getElementById("passwordLabel").value;
  if(!email || !password){
    alert('Please fill in all the fields')
    return;
  }
  const formData = new FormData();
  formData.append('S_email', email);
  formData.append('S_password', password);
  fetch('scripts/validate_login.php', {
    method: 'POST',
    body: formData
  })

  .then(response => response.json()) // Process the server's response
    .then(data => {
        if (data.success) {
            alert('Login successful!');
            // Redirect or perform actions for successful login
            localStorage.setItem("authToken", data.token);
            window.location.replace("index.php");
        } else {
            alert('Invalid username or password');
        }
    })
    .catch(error => console.error('Error:', error)); // Handle network or other errors
});
