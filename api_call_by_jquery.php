<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Data</title>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
// Fetch data from the API using jQuery
$.ajax({
    url: 'http://localhost/tm/src/api/hotel_api.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        // Get the table body element
        const tableBody = $('#hotelTableBody');

        // Iterate through the data and create table rows
        $.each(data, function(index, hotel) {
            const row = $('<tr>');

            // Add data to the table cells
            $.each(hotel, function(key, value) {
                const cell = $('<td>').text(value);
                row.append(cell);
                alert(key+ ' = "' +value+'"');
            });
           
            // Append the row to the table body
            tableBody.append(row);
        });
    },
    error: function(error) {
        console.error('Error fetching data:', error);
    }
});
</script>

</body>
</html>
