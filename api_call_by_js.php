<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Data</title>
</head>
<body>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody id="hotelTableBody"></tbody>
</table>

<script>
// Fetch data from the API
fetch('http://localhost/tm/src/api/hotel_api_pdo_conn.php')
    .then(response => response.json())
    .then(data => {
        // Get the table body element
        const tableBody = document.getElementById('hotelTableBody');

        // Iterate through the data and create table rows
        data.forEach(hotel => {
            const row = document.createElement('tr');

            // Add data to the table cells
            Object.values(hotel).forEach(value => {
                const cell = document.createElement('td');
                cell.textContent = value;
                row.appendChild(cell);
            });

            // Append the row to the table body
            tableBody.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching data:', error));
</script>

</body>
</html>
