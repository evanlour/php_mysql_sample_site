document.addEventListener("DOMContentLoaded", function () {
    const formData = new FormData();
    if(localStorage.getItem("authToken") !== null){
        formData.append('token', localStorage.getItem("authToken"));
        fetch("scripts/auth_check.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data['success'] == true){
                console.log(data)
                window.location.replace("index.php");
            }
        }) // Change this to update UI
        .catch(error => console.error("Error fetching data:", error));
}});