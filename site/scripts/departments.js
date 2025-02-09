document.addEventListener("DOMContentLoaded", () => {
    const select = document.getElementById('departmentOption');
    const remDep = document.getElementById('removeDepartmentOption');
    profileOptionsData.forEach(department => {
        const option = document.createElement('option');
        option.value = department.D_name; // Set the value to the department ID
        option.textContent = department.D_name; // Display the department name
        select.appendChild(option);
        optionClone = option.cloneNode(true);
        remDep.appendChild(optionClone); 
    });
});

const existingDepartments = [];
document.getElementById("departmentOption").addEventListener('change', () => {
    const depDataBody = document.getElementById('depDataBody');
    const selectedDepartmentID = document.getElementById('departmentOption').value;
    if(selectedDepartmentID != ''){
        const formData = new FormData();
        formData.append('depOption', selectedDepartmentID);
        fetch('scripts/get_dep_data.php', {
            method: 'POST',
            body: formData
        })

        .then(response => response.json())
            .then(data => {
                data.forEach(row => {
                    if(!existingDepartments.includes(row.D_name)){
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${row.D_name}</td>
                            <td>${row.D_ID}</td>
                            <td>${row.D_num_of_emp}</td>
                        `;
                        depDataBody.append(tr);
                        existingDepartments.push(row.D_name);
                    }
                })
            })
    }
});

let addDepartmentButton = document.getElementById("addDepartmentButton");
addDepartmentButton.addEventListener('click', function(event){
  event.preventDefault();
  const departmentName = document.getElementById("addDepartmentNameLabel").value;
  const departmentID = document.getElementById("addDepartmentIDLabel").value;
  if(!departmentName || !departmentID){
    alert('Please fill in all the values')
    return;
  }
  const formData = new FormData();
  formData.append('depAddName', departmentName);
  formData.append('depAddID', departmentID);
  formData.append('depNum', 0);
  fetch('scripts/add_department.php', {
    method: 'POST',
    body: formData
  })

  .then(response => response.json()) // Process the server's response
    .then(data => {
        if (data.success) {
            alert('Department added!');
            // Redirect or perform actions for successful login
            window.location.replace("departments.php?");
        } else {
            alert('An error occured');
        }
    })
    .catch(error => console.error('Error:', error)); // Handle network or other errors
});

let removeDepartmentButton = document.getElementById("removeDepartmentButton");
removeDepartmentButton.addEventListener('click', function(event){
    event.preventDefault();
    const department = document.getElementById("removeDepartmentOption").value;
    if(department != ""){
        const formData = new FormData();
        formData.append('depRem', department);
        fetch('scripts/remove_department.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Department removed!');
                  // Redirect or perform actions for successful login
                  window.location.replace("departments.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});
