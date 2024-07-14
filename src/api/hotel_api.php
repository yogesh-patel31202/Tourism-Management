<?php

// Set the response content type to JSON
header('Content-Type: application/json');
require_once(__DIR__ . '/DataDb.php');

$db = new DataDb();

// Perform the SQL query
$query = "SELECT id, name, description, location, status FROM hotels_tb";
$stmt = $db->connection->query($query);
$hotels = $stmt->fetch_all();

// Return the result as JSON
echo json_encode($hotels);
