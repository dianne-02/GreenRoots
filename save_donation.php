<?php
// Tiyakin na ang 'db.php' ay tama ang koneksyon sa database ($conn)
require 'db.php'; 

// 1. INPUT VALIDATION: Siguraduhin na ang form ay na-submit via POST at may laman ang fields.
if ($_SERVER["REQUEST_METHOD"] == "POST" && 
    isset($_POST['name'], $_POST['email'], $_POST['contact'], $_POST['amount'])) {
    
    // 2. KUNIN ANG DATA AT I-SANITIZE
    // Kapag gumagamit ng prepared statements, hindi kailangan ang manual sanitization.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    // I-convert sa float ang amount (para sigurado na number ang input)
    $amount = (float)$_POST['amount']; 

    // 3. PREPARED STATEMENT: Ito ang pinakaligtas na paraan (anti-SQL Injection).
    // PALITAN ang 'donations' ng tamang table name kung iba ang gamit ninyo.
    // Tiyakin na ang column names (full_name, email, contact_number, donation_amount) ay tugma.
    $sql = "INSERT INTO donations (full_name, email, contact_number, donation_amount)
            VALUES (?, ?, ?, ?)";

    // I-prepare ang statement
    if ($stmt = $conn->prepare($sql)) {
        // I-bind ang parameters: 's' para sa string (name, email, contact), 'd' para sa double/decimal (amount)
        $stmt->bind_param("sssd", $name, $email, $contact, $amount);
        
        // I-execute
        if ($stmt->execute()) {
            // Success
            echo "success"; 
        } else {
            // Failed to execute query
            error_log("Database error: " . $stmt->error);
            echo "error: Failed to save donation.";
        }

        // Isara ang statement
        $stmt->close();
    } else {
        // Failed to prepare statement
        error_log("Prepared statement error: " . $conn->error);
        echo "error: System error occurred.";
    }

} else {
    // Ito ang lalabas kung in-access ng diretso ang script o may kulang na field
    echo "error: Invalid request or missing donation details.";
}
?>