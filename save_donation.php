<?php
// 1. I-include ang tamang file name. Ang $conn ay galing na sa db.php
require_once 'db.php'; 

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Collect and Sanitize the data, gamit ang Procedural na function: mysqli_real_escape_string($conn, $data)
    $donor_name = mysqli_real_escape_string($conn, trim($_POST['donor_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $country_code = mysqli_real_escape_string($conn, trim($_POST['country_code']));
    $contact = mysqli_real_escape_string($conn, trim($_POST['contact']));
    
    // Validate the amount (ensures it's a valid positive number)
    $amount = filter_var(trim($_POST['amount']), FILTER_VALIDATE_FLOAT);
    
    // Combine the contact number
    $full_contact = $country_code . $contact;

    // 3. Basic Validation
    if (empty($donor_name) || empty($email) || empty($contact) || $amount === false || $amount <= 0) {
        header("Location: donate.php?status=error");
        exit;
    }
    
    // 4. Prepare the SQL INSERT statement
    $sql = "INSERT INTO donations (donor_name, email, contact, amount, donation_date)
            VALUES ('$donor_name', '$email', '$full_contact', '$amount', NOW())";
            
    // 5. Execute the query, gamit ang Procedural na function: mysqli_query($conn, $sql)
    if (mysqli_query($conn, $sql)) {
        // Success
        header("Location: donate.php?status=success");
        exit;
    } else {
        // Failure
        header("Location: donate.php?status=error");
        exit;
    }

    // 6. Close the database connection
    mysqli_close($conn);

} else {
    // Direct access blocked
    header("Location: donate.php");
    exit;
}
?>