<?php
// Tiyakin na ang path ay tama, umaakyat ng isang level (..) papunta sa db.php
require '../db.php'; 

header('Content-Type: application/json');

$response = [
    'success' => false,
    'total' => 0,
    'unread' => 0, // Siguraduhin na may default value
    'error' => ''
];

$sql_total = "SELECT COUNT(id) as total_count FROM messages";
$sql_unread = "SELECT COUNT(id) as unread_count FROM messages WHERE is_read = FALSE";

// Get Total Count
if ($result = $conn->query($sql_total)) {
    $row = $result->fetch_assoc();
    $response['total'] = (int)$row['total_count'];
    $result->close();
} else {
    $response['error'] = "Total Count Query Failed: " . $conn->error;
    $conn->close();
    echo json_encode($response);
    exit();
}

// Get Unread Count
if ($result = $conn->query($sql_unread)) {
    $row = $result->fetch_assoc();
    // Tiyakin na ang $row['unread_count'] ay tama ang variable name
    $response['unread'] = (int)$row['unread_count']; 
    $response['success'] = true;
    $result->close();
} else {
    $response['error'] = "Unread Count Query Failed: " . $conn->error;
    // Hindi na kailangan i-exit dito, hayaan ang final encode
}

$conn->close();
echo json_encode($response);
?>