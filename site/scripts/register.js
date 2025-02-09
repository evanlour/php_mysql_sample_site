const icon = document.getElementById('passwordIcon');
const repeatIcon = document.getElementById('repeatPasswordIcon');
let passwordVis = document.getElementById('passwordLabel');
let repeatPasswordVis = document.getElementById('repeatPasswordLabel');

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

repeatIcon.addEventListener('click', function() {
    if(repeatPasswordVis.type === "password") {
      repeatPasswordVis.type = "text";
      repeatIcon.classList.add("bi-eye-slash-fill");
      repeatIcon.classList.remove("bi-eye");
    }
    else {
      repeatPasswordVis.type = "password";
      repeatIcon.classList.add("bi-eye");
      repeatIcon.classList.remove("bi-eye-slash-fill");
    }
  });

let registerButton = document.getElementById("registerButton");
registerButton.addEventListener('click', function(event){
  event.preventDefault();
  const email = document.getElementById("emailLabel").value;
  const realName = document.getElementById("realNameLabel").value;
  const surname = document.getElementById("surnameLabel").value;
  const username = document.getElementById("usernameLabel").value;
  const password = document.getElementById("passwordLabel").value;
  const repeatPassowrd = document.getElementById("repeatPasswordLabel").value;
  if(email.includes(' ') || !email.includes('@')){
    alert('The email must not have spaces and must include @');
    return;
  }
  if(realName.includes(' ') || surname.includes(' ') || username.includes(' ')){
    alert('Namespaces must not contain spaces')
    return;
  }
  if(password != repeatPassowrd){
    alert('The passwords do not match!');
    return;
  }

  const formData = new FormData();
  formData.append('S_email', email);
  formData.append('S_name', realName);
  formData.append('S_surname', surname);
  formData.append('S_username', username);
  formData.append('S_password', password);
  fetch('scripts/validate_register.php', {
    method: 'POST',
    body: formData
  })

  .then(response => response.json()) // Process the server's response
    .then(data => {
        if (data.success) {
          const formData = new FormData();
          formData.append('S_email', email);
          formData.append('S_password', password);
          fetch('scripts/validate_login.php', {
            method: 'POST',
            body: formData
          })
        
          .then(response => response.json()) // Process the server's response
            .then(data => {
              console.log(data);
                if (data.success) {
                    // Redirect or perform actions for successful login
                    localStorage.setItem("authToken", data.token);
                    window.location.href = "index.php";
                }
            })
            .catch(error => console.error('Error:', error)); // Handle network or other errors
        } else {
            alert('Something went wrong, please try again later!');
        }
    })
    .catch(error => console.error('Error:', error)); // Handle network or other errors

})
  