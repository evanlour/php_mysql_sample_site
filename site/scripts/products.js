document.addEventListener("DOMContentLoaded", () => {
    const remProd = document.getElementById('removeProductOption');
    productOptionData.forEach(product => {
        const option = document.createElement('option');
        option.value = product.P_name; // Set the value to the department ID
        option.textContent = product.P_name; // Display the department name
        remProd.appendChild(option);
    });

    const prodBody = document.getElementById("prodDataBody");
    productOptionData.forEach(rowData => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${rowData.P_name}</td>
            <td>${rowData.P_ID}</td>
            <td>${rowData.P_quantity}</td>
            <td>${rowData.P_price}</td>
        `;
        prodBody.appendChild(row);
    });
});

let addProductButton = document.getElementById("addProductButton");
addProductButton.addEventListener('click', function(event){
  event.preventDefault();
  const productName = document.getElementById("addProductNameLabel").value;
  const productID = document.getElementById("addProductIDLabel").value;
  const productQuantity = document.getElementById("addProductQuantityLabel").value;
  const productPrice = document.getElementById("addProductPriceLabel").value;
  if(!productName || !productID || !productQuantity || !productPrice){
    alert('Please fill in all values')
    return;
  }
  const formData = new FormData();
  formData.append('prodAddName', productName);
  formData.append('prodAddID', productID);
  formData.append('prodAddQuan', productQuantity);
  formData.append('prodAddPrice', productPrice);
  fetch('scripts/add_product.php', {
    method: 'POST',
    body: formData
  })

  .then(response => response.json()) // Process the server's response
    .then(data => {
        if (data.success) {
            alert('Product added!');
            // Redirect or perform actions for successful login
            window.location.replace("products.php?");
        } else {
            alert('An error occured');
        }
    })
    .catch(error => console.error('Error:', error)); // Handle network or other errors
});

let removeProductButton = document.getElementById("removeProductButton");
removeProductButton.addEventListener('click', function(event){
    event.preventDefault();
    const product = document.getElementById("removeProductOption").value;
    if(product != ""){
        const formData = new FormData();
        formData.append('prodRem', product);
        fetch('scripts/remove_product.php', {
          method: 'POST',
          body: formData
        })
      
        .then(response => response.json()) // Process the server's response
          .then(data => {
              if (data.success) {
                  alert('Product removed!');
                  // Redirect or perform actions for successful login
                  window.location.replace("products.php?");
              } else {
                  alert('An error occured');
              }
          })
          .catch(error => console.error('Error:', error)); // Handle network or other errors
    }
});
