const connectProd = document.getElementById("connectProdOption");
const connectSupplierProd = document.getElementById("connectSupplierProdOption");
const connectDep = document.getElementById("connectDepOption");
const connectSupplierDep = document.getElementById("connectSupplierDepOption");
const disconnectProd = document.getElementById("disconnectProdOption");
const disconnectSupplierProd = document.getElementById("disconnectSupplierProdOption");
const disconnectDep = document.getElementById("disconnectDepOption");
const disconnectSupplierDep = document.getElementById("disconnectSupplierDepOption");
const removeSupplier = document.getElementById('removeSupplierOption');

document.addEventListener("DOMContentLoaded", () => {
    const supplierBody = document.getElementById('supDataBody');
    supplierData.forEach(supplier => {
        const row = document.createElement('tr');
        let Seasonality = true;
        if(supplier.S_is_temp === '0'){
            Seasonality = false;
        }
        row.innerHTML = `
            <td>${supplier.S_name}</td>
            <td>${Seasonality}</td>
        `;
        supplierBody.appendChild(row);

        const option = document.createElement('option');
        option.value = supplier.S_name;
        option.textContent = supplier.S_name;
        optionClone1 = option.cloneNode(true);
        optionClone2 = option.cloneNode(true);
        optionClone3 = option.cloneNode(true);
        optionClone4 = option.cloneNode(true);
        connectSupplierProd.appendChild(option);
        connectSupplierDep.appendChild(optionClone1);
        disconnectSupplierProd.appendChild(optionClone2);
        disconnectSupplierDep.appendChild(optionClone3);
        removeSupplier.appendChild(optionClone4);
    });

    productData.forEach(product => {
        const option = document.createElement('option');
        option.value = product.P_ID;
        option.textContent = product.P_name;
        optionClone = option.cloneNode(true);
        connectProd.appendChild(option);
        disconnectProd.appendChild(optionClone);
    });

    departmentData.forEach(department => {
        const option = document.createElement('option');
        option.value = department.D_ID;
        option.textContent = department.D_name;
        optionClone = option.cloneNode(true);
        connectDep.appendChild(option);
        disconnectDep.appendChild(optionClone);
    });
});

document.getElementById('addSupplierButton').addEventListener('click', function(event){
    event.preventDefault();
    const supplierName = document.getElementById("addSupplierNameLabel").value;
    const supplierSeasonalityOption = document.getElementById('addSupplierSeasonalityOption').value;
    const supplierSeasonality = (supplierSeasonalityOption === 'yes') ? '1' : '0';
    if(!supplierName){
      alert('Please fill in the supplier field')
      return;
    }
    const formData = new FormData();
    formData.append('supplierName', supplierName);
    formData.append('supplierSeasonality', supplierSeasonality);
    fetch('scripts/add_supplier.php', {
      method: 'POST',
      body: formData
    })
  
    .then(response => response.json()) // Process the server's response
      .then(data => {
          if (data.success) {
              alert('Supplier added!');
              // Redirect or perform actions for successful login
              window.location.replace("suppliers.php?");
          } else {
              alert('An error occured');
          }
      })
      .catch(error => console.error('Error:', error)); // Handle network or other errors
  });

document.getElementById('removeSupplierButton').addEventListener('click', function(event){
    event.preventDefault();
    const supplierName = document.getElementById("removeSupplierOption").value;
    if(!supplierName){
        alert('Please fill in the supplier field')
        return;
    }
    const formData = new FormData();
    formData.append('supplierName', supplierName);
    fetch('scripts/remove_supplier.php', {
        method: 'POST',
        body: formData
    })

    .then(response => response.json()) // Process the server's response
        .then(data => {
            if (data.success) {
                alert('Supplier removed!');
                // Redirect or perform actions for successful login
                window.location.replace("suppliers.php?");
            } else {
                alert('An error occured');
            }
        })
        .catch(error => console.error('Error:', error)); // Handle network or other errors
});

document.getElementById('connectProductButton').addEventListener('click', function(event){
    event.preventDefault();
    const supplierName = document.getElementById("connectSupplierProdOption").value;
    const productID = document.getElementById("connectProdOption").value;
    if(!supplierName || !productID){
      alert('Please fill in the fields')
      return;
    }
    const formData = new FormData();
    formData.append('supplierName', supplierName);
    formData.append('productID', productID);
    fetch('scripts/connect_product.php', {
      method: 'POST',
      body: formData
    })
  
    .then(response => response.json()) // Process the server's response
      .then(data => {
          if (data.success) {
              alert('Connection added!');
              // Redirect or perform actions for successful login
              window.location.replace("suppliers.php?");
          } else {
              alert('An error occured');
          }
      })
      .catch(error => console.error('Error:', error)); // Handle network or other errors
  });

document.getElementById('disconnectProductButton').addEventListener('click', function(event){
    event.preventDefault();
    const supplierName = document.getElementById("disconnectSupplierProdOption").value;
    const productID = document.getElementById("disconnectProdOption").value;
    if(!supplierName || !productID){
      alert('Please fill in the fields')
      return;
    }
    const formData = new FormData();
    formData.append('supplierName', supplierName);
    formData.append('productID', productID);
    fetch('scripts/disconnect_product.php', {
      method: 'POST',
      body: formData
    })
  
    .then(response => response.json()) // Process the server's response
      .then(data => {
          if (data.success) {
              alert('Connection removed!');
              // Redirect or perform actions for successful login
              window.location.replace("suppliers.php?");
          } else {
              alert('An error occured');
          }
      })
      .catch(error => console.error('Error:', error)); // Handle network or other errors
  });

document.getElementById('connectDepButton').addEventListener('click', function(event){
    event.preventDefault();
    const supplierName = document.getElementById("connectSupplierDepOption").value;
    const departmentID = document.getElementById("connectDepOption").value;
    if(!supplierName || !departmentID){
      alert('Please fill in the fields')
      return;
    }
    const formData = new FormData();
    formData.append('supplierName', supplierName);
    formData.append('departmentID', departmentID);
    fetch('scripts/connect_department.php', {
      method: 'POST',
      body: formData
    })
  
    .then(response => response.json()) // Process the server's response
      .then(data => {
          if (data.success) {
              alert('Connection added!');
              // Redirect or perform actions for successful login
              window.location.replace("suppliers.php?");
          } else {
              alert('An error occured');
          }
      })
      .catch(error => console.error('Error:', error)); // Handle network or other errors
  });

document.getElementById('disconnectDepButton').addEventListener('click', function(event){
    event.preventDefault();
    const supplierName = document.getElementById("disconnectSupplierDepOption").value;
    const departmentID = document.getElementById("disconnectDepOption").value;
    if(!supplierName || !departmentID){
      alert('Please fill in the fields')
      return;
    }
    const formData = new FormData();
    formData.append('supplierName', supplierName);
    formData.append('departmentID', departmentID);
    fetch('scripts/disconnect_department.php', {
      method: 'POST',
      body: formData
    })
  
    .then(response => response.json()) // Process the server's response
      .then(data => {
          if (data.success) {
              alert('Connection removed!');
              // Redirect or perform actions for successful login
              window.location.replace("suppliers.php?");
          } else {
              alert('An error occured');
          }
      })
      .catch(error => console.error('Error:', error)); // Handle network or other errors
  });


