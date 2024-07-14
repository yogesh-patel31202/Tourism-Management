<?php

header('Content-Type: application/json');

// Example data (you might replace this with data from a database)
$users = [
    ['id' => 1, 'name' => 'John Doe'],
    ['id' => 2, 'name' => 'Jane Smith'],
];

// Handle GET request for the list of users
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'users') {
    echo json_encode($users);
    exit;
}

// Handle GET request for a specific user by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'user' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = array_filter($users, function ($u) use ($userId) {
        return $u['id'] == $userId;
    });
    echo json_encode(array_values($user));
    exit;
}

// Handle other endpoints or methods as needed

http_response_code(404);
echo json_encode(['error' => 'Not Found']);
