document.addEventListener("DOMContentLoaded", () => {
    const indexBody = document.getElementById('indexBody');
    const rows = [
        {label: "Number of departments", value: indexData[0].ct},
        {label: "Number of Employees", value: indexData[1].ct},
        {label: "Number of Products($)", value: indexData[2].ct},
        {label: "Average employee salary($)", value: Math.floor(indexData[3].avg)},
        {label: "Max employee salary($)", value: indexData[4].max},
        {label: "Average product price($)", value: Math.floor(indexData[5].avg)},
        {label: "Max product price($)", value: indexData[6].max},
        {label: "Most Common product", value: indexData[7].max},
        {label: "Department with the most expenses", value: (indexData[8].DEP_NAME + " With " + indexData[8].TOTAL_COST)}
    ];

    rows.forEach(rowData =>{
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${rowData.label}</td>
            <td>${rowData.value}</td>
        `;
        indexBody.appendChild(row);
    });
});
