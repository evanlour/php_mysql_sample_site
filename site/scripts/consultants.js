document.addEventListener("DOMContentLoaded", () => {
    const getConComp = document.getElementById('conCompOption');
    const remConComp = document.getElementById('removeConCompOption');
    const connectComp = document.getElementById('connectCompOption');
    const connectComCom = document.getElementById('connectComComOption');
    const connectDep = document.getElementById('connectComDepOption');
    const disconnectComCom = document.getElementById('disconnectComComOption');
    const disconnectDep = document.getElementById('disconnectComDepOption');
    const disconnectComp = document.getElementById('disconnectCompOption');
    conCompData.forEach(conComp => {
        const option = document.createElement('option');
        option.value = conComp.C_email; // Set the value to the department ID
        option.textContent = conComp.C_name; // Display the department name
        getConComp.appendChild(option);
        optionClone1 = option.cloneNode(true);
        optionClone2 = option.cloneNode(true);
        optionClone3 = option.cloneNode(true);
        optionClone4 = option.cloneNode(true);
        optionClone5 = option.cloneNode(true);
        remConComp.appendChild(optionClone1); 
        connectComp.appendChild(optionClone2);
        connectComCom.appendChild(optionClone3);
        disconnectComCom.appendChild(optionClone4);
        disconnectComp.appendChild(optionClone5);
    });

    departmentData.forEach(dep => {
        const option = document.createElement('option');
        option.value = dep.D_ID;
        option.textContent = dep.D_name;
        connectDep.appendChild(option);
        optionClone = option.cloneNode(true);
        disconnectDep.appendChild(optionClone);
    })

    const connectAnalystOption = document.getElementById("connectAnalystOption");
    const disconnectAnalystOption = document.getElementById("disconnectAnalystOption");
    const removeAnalystOption = document.getElementById("removeAnalystOption");
    analystData.forEach(analyst => {
        const option = document.createElement('option');
        option.value = analyst.A_ID; // Set the value to the department ID
        option.textContent = analyst.A_name; // Display the department name
        connectAnalystOption.appendChild(option);
        optionClone1 = option.cloneNode(true);
        optionClone2 = option.cloneNode(true);
        removeAnalystOption.appendChild(optionClone1);
        disconnectAnalystOption.appendChild(optionClone2); 
    });
});

document.getElementById("conCompOption").addEventListener('change', () => {
    const conCompDataBody = document.getElementById('conCompBody');
    const conCompEmail = document.getElementById('conCompOption').value;
    const anaBody = document.getElementById('conAnaBody');
    anaBody.innerHTML = ``;
    conCompDataBody.innerHTML = ``;
    if(conCompEmail != ''){
        const formData = new FormData();
        formData.append('conCompEmail', conCompEmail);
        fetch('scripts/get_con_comp_data.php', {
            method: 'POST',
            body: formData
        })

        .then(response => response.json())
            .then(data => {
                const trC1 = document.createElement('tr');
                const trC2 = document.createElement('tr');
                const trC3 = document.createElement('tr');
                trC1.innerHTML = `
                <th>Name:</th>
                <td>${data["conCompData"][0].C_name}</td>`;
                trC2.innerHTML = `
                <th>Email:</th>
                <td>${data["conCompData"][0].C_email}</td>`;
                trC3.innerHTML = `
                <th>Location:</th>
                <td>${data["conCompData"][0].C_location}</td>`;
                conCompDataBody.appendChild(trC1);
                conCompDataBody.appendChild(trC2);
                conCompDataBody.appendChild(trC3);

                data["analystData"].forEach(analyst => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${analyst.A_name}</td>
                    <td>${analyst.A_ID}</td>
                    `;
                    anaBody.appendChild(tr);
                });
            })
    }
});

let addConCompButton = document.getElementById("addConCompButton");
addConCompButton.addEventListener('click', function(event){
  event.preventDefault();
  const conCompName = document.getElementById("addConCompNameLabel").value;
  const conCompEmail = document.getElementById("addConCompEmailLabel").value;
  const conCompLocation = document.getElementById("addConCompLocationLabel").value;
  if(!conCompEmail || !conCompLocation || !conCompName){
    alert('Please fill in all values')
    return;
  }
  const formData = new FormData();
  formData.append('conCompName', conCompName);
  formData.append('conCompEmail', conCompEmail);
  formData.append('conCompLocation', conCompLocation);
  fetch('scripts/add_con_comp.php', {
    method: 'POST',
    body: formData
  })

  .then(response => response.json()) // Process the server's response
    .then(data => {
        if (data.success) {
            alert('Consulting Company added!');
            // Redirect or perform actions for successful login
            window.location.replace("consultants.php?");
        } else {
            alert('An error occured');
        }
    })
    .catch(error => console.error('Error:', error)); // Handle network or other errors
});

document.getElementById("addAnalystButton").addEventListener('click', function(event){
    event.preventDefault();
    const analystName = document.getElementById("addAnalystNameLabel").value;
    const analystID = document.getElementById("addAnalystIDLabel").value;
    if(!analystID || !analystName){
      alert('Please fill in all values')
      return;
    }
    const formData = new FormData();
    formData.append('analystName', analystName);
    formData.append('analystID', analystID);
    fetch('scripts/add_analyst.php', {
      method: 'POST',
      body: formData
    })
  
    .then(response => response.json()) // Process the server's response
      .then(data => {
          if (data.success) {
              alert('Analyst added!');
              // Redirect or perform actions for successful login
              window.location.replace("consultants.php?");
          } else {
              alert('An error occured');
          }
      })
      .catch(error => console.error('Error:', error)); // Handle network or other errors
  });

let removeConCompButton = document.getElementById("removeConCompButton");
removeConCompButton.addEventListener('click', function(event){
    event.preventDefault();
    const conCompEmail = document.getElementById("removeConCompOption").value;
    if(conCompEmail != ""){
        const formData = new FormData();
        formData.append('conCompEmail', conCompEmail);
        fetch('scripts/remove_con_comp.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Consulting Company removed!');
                  // Redirect or perform actions for successful login
                  window.location.replace("consultants.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});

let removeAnalystButton = document.getElementById("removeAnalystButton");
removeAnalystButton.addEventListener('click', function(event){
    event.preventDefault();
    const analystID = document.getElementById("removeAnalystOption").value;
    if(analystID != ""){
        const formData = new FormData();
        formData.append('analystID', analystID);
        fetch('scripts/remove_analyst.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Analyst removed!');
                  // Redirect or perform actions for successful login
                  window.location.replace("consultants.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});

let connectAnaComButton = document.getElementById("connectCompButton");
connectAnaComButton.addEventListener('click', function(event){
    event.preventDefault();
    const analystID = document.getElementById("connectAnalystOption").value;
    const companyEmail = document.getElementById("connectCompOption").value;
    if(analystID != "" && companyEmail != ""){
        const formData = new FormData();
        formData.append('analystID', analystID);
        formData.append('companyEmail', companyEmail);
        fetch('scripts/connect_analyst.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Connection Added!');
                  // Redirect or perform actions for successful login
                  window.location.replace("consultants.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});

let connectDepButton = document.getElementById("connectDepButton");
connectDepButton.addEventListener('click', function(event){
    event.preventDefault();
    const departmentID = document.getElementById("connectComDepOption").value;
    const companyEmail = document.getElementById("connectComComOption").value;
    if(departmentID != "" && companyEmail != ""){
        const formData = new FormData();
        formData.append('departmentID', departmentID);
        formData.append('companyEmail', companyEmail);
        fetch('scripts/connect_company.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Connection Added!');
                  // Redirect or perform actions for successful login
                  window.location.replace("consultants.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});

let disconnectAnaComButton = document.getElementById("disconnectCompButton");
disconnectAnaComButton.addEventListener('click', function(event){
    event.preventDefault();
    const analystID = document.getElementById("disconnectAnalystOption").value;
    const companyEmail = document.getElementById("disconnectCompOption").value;
    if(analystID != "" && companyEmail != ""){
        const formData = new FormData();
        formData.append('analystID', analystID);
        formData.append('companyEmail', companyEmail);
        fetch('scripts/disconnect_analyst.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Connection Removed!');
                  // Redirect or perform actions for successful login
                  window.location.replace("consultants.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});

let disconnectDepButton = document.getElementById("disconnectDepButton");
disconnectDepButton.addEventListener('click', function(event){
    event.preventDefault();
    const departmentID = document.getElementById("disconnectComDepOption").value;
    const companyEmail = document.getElementById("disconnectComComOption").value;
    if(departmentID != "" && companyEmail != ""){
        const formData = new FormData();
        formData.append('departmentID', departmentID);
        formData.append('companyEmail', companyEmail);
        fetch('scripts/disconnect_company.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Connection Removed!');
                  // Redirect or perform actions for successful login
                  window.location.replace("consultants.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});
