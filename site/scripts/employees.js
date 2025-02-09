document.addEventListener("DOMContentLoaded", () => {
    const remEmp = document.getElementById('addEmployeeDepOption');
    const select = document.getElementById('removeEmployeeOption');
    employeeData.forEach(employee => {
        const option = document.createElement('option');
        option.value = employee.E_name; // Set the value to the department ID
        option.textContent = employee.E_name; // Display the department name
        select.appendChild(option);
    });
    departmentData.forEach(department => {
        const option = document.createElement('option');
        option.value = department.D_ID; // Set the value to the department ID
        option.textContent = department.D_name; // Display the department name
        remEmp.appendChild(option);
    });

    const empBody = document.getElementById("empDataBody");
    employeeData.forEach(rowData => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${rowData.E_name}</td>
            <td>${rowData.E_ID}</td>
            <td>${rowData.E_salary}</td>
            <td>${rowData.D_name} (${rowData.E_cur_dep_ID})</td>
        `;
        empBody.appendChild(row);
    });
});

let addEmployeeButton = document.getElementById("addEmployeeButton");
addEmployeeButton.addEventListener('click', function(event){
  event.preventDefault();
  const employeeName = document.getElementById("addEmployeeNameLabel").value;
  const employeeID = document.getElementById("addEmployeeIDLabel").value;
  const employeeSalary = document.getElementById("addEmployeeSalaryLabel").value;
  const employeeDep = document.getElementById("addEmployeeDepOption").value;
  if(!employeeName || !employeeID || !employeeSalary || employeeDep===""){
    alert('Please fill in all the values')
    return;
  }
  const formData = new FormData();
  formData.append('empAddName', employeeName);
  formData.append('empAddID', employeeID);
  formData.append('empAddSalary', employeeSalary);
  formData.append('empAddDep', employeeDep);
  fetch('scripts/add_employee.php', {
    method: 'POST',
    body: formData
  })

  .then(response => response.json()) // Process the server's response
    .then(data => {
        if (data.success) {
            alert('Employee added!');
            // Redirect or perform actions for successful login
            window.location.replace("employees.php");
        } else {
            alert('An error occured');
        }
    })
    .catch(error => console.error('Error:', error)); // Handle network or other errors
});

let removeEmployeeButton = document.getElementById("removeEmployeeButton");
removeEmployeeButton.addEventListener('click', function(event){
    event.preventDefault();
    const employee = document.getElementById("removeEmployeeOption").value;
    if(employee != ""){
        const formData = new FormData();
        formData.append('empRem', employee);
        fetch('scripts/remove_employee.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Employee removed!');
                  // Redirect or perform actions for successful login
                  window.location.replace("employees.php");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});
