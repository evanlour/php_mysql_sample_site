document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById('profileDataBody')
    const user = profileData[0];
    const rows = [
        {label: "Name", value: user.S_name},
        {label: "Surname", value: user.S_surname},
        {label: "Email", value: user.S_email},
        {label: "Username", value: user.S_username}
    ];

    rows.forEach(rowData =>{
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${rowData.label}</td>
            <td>${rowData.value}</td>
        `;
        tableBody.appendChild(row);
    });

});

const deleteButton = document.getElementById("deleteButton");
deleteButton.addEventListener("click", () => {
    const confirmation = confirm("Are you sure you want to delete your account?");
    if(confirmation){
        window.location.replace("scripts/delete_account.php?");
    }
})
