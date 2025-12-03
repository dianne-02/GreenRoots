<?php
// BINAGO: Gumamit ng '../db.php' para umakyat ng isang folder at hanapin ang db.php
require '../db.php'; 

header('Content-Type: application/json');

$response = [
    'success' => false,
    'messages' => [],
    'error' => ''
];

// Query: Kunin lahat ng messages, i-order by newest first.
$sql = "SELECT id, full_name, email, subject, message, created_at, is_read FROM messages ORDER BY created_at DESC";

if ($result = $conn->query($sql)) {
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    $response['success'] = true;
    $response['messages'] = $messages;
    $result->close();
} else {
    $response['error'] = "Database Query Failed: " . $conn->error;
}

$conn->close();
echo json_encode($response);
?>