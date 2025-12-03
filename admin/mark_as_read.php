<?php
// BINAGO: Gumamit ng '../db.php'
require '../db.php';

header('Content-Type: application/json');

$response = ['success' => false, 'error' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $message_id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $mark_read = isset($_POST['mark_read']) ? 1 : 0; // 1 for read, 0 for unread

    if ($message_id) {
        $sql = "UPDATE messages SET is_read = ? WHERE id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ii", $mark_read, $message_id);

            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['error'] = "Database Execution Failed: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['error'] = "SQL Prepare Failed: " . $conn->error;
        }
    } else {
        $response['error'] = "Invalid Message ID.";
    }
} else {
    $response['error'] = "Invalid Request Method or missing ID.";
}

$conn->close();
echo json_encode($response);
?>