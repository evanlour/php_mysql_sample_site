
document.addEventListener("DOMContentLoaded", function () {
    const formData = new FormData();
    formData.append('token', localStorage.getItem("authToken"));
    fetch("scripts/auth_check.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data['success'] === false){
            window.location.replace("login.php");
        }
    }) // Change this to update UI
    .catch(error => console.error("Error fetching data:", error));
});