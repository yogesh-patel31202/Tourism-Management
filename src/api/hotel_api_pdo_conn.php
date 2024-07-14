<?php

// Set the response content type to JSON
header('Content-Type: application/json');

// Database connection details
$host = 'localhost:3306';
$db = 'tourism_management';
$user = 'root';
$pass = '';

// Create a PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Perform the SQL query
$query = "SELECT id, name, description, location, status FROM hotels_tb";
$stmt = $pdo->query($query);
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the result as JSON
echo json_encode($hotels);
