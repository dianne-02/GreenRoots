<?php
// Siguraduhin na ang 'db.php' ay tama ang koneksyon sa database ($conn)
require 'db.php'; 

// 1. INPUT VALIDATION & SECURITY CHECK
if ($_SERVER["REQUEST_METHOD"] == "POST" && 
    isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    
    // 2. KUNIN ANG DATA
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // 3. PREPARED STATEMENT
    // Tiyakin na ang table name ay 'messages'
    $sql = "INSERT INTO messages (full_name, email, subject, message)
            VALUES (?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        
        // Bind parameters: 's' (string) for all four inputs
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        // Execute
        if ($stmt->execute()) {
            // Success
            echo "success"; 
        } else {
            // ERROR HANDLING: Ibalik ang detalye ng database error
            error_log("Database execution error: " . $stmt->error);
            echo "error: Database execution failed. Check server logs.";
        }

        $stmt->close();
    } else {
        // ERROR HANDLING: Ibalik ang detalye kung nag-fail i-prepare ang statement
        error_log("Prepared statement error: " . $conn->error);
        echo "error: System error (Prepare failed).";
    }

} else {
    // Kung hindi POST request o may kulang sa fields (GET request)
    echo "error: Invalid request or missing fields.";
}
?>