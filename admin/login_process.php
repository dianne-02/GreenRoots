<?php
// FILE: login_process.php (NEW NAME)

// Tiyakin na sinimulan ang session
session_start();

// ------------------------------------------------------------------
// --- I-SET ANG IYONG ISANG ADMIN CREDENTIALS DITO (MAHALAGA) ---
// ------------------------------------------------------------------
$admin_username = "admin67"; 
$admin_password = "admin67"; 
// ------------------------------------------------------------------

// Kunin ang data na ipinasa mula sa form
$input_username = $_POST['username'] ?? '';
$input_password = $_POST['password'] ?? '';

// I-check kung tugma ang credentials
if ($input_username === $admin_username && $input_password === $admin_password) {
    
    // LOGIN SUCCESSFUL
    
    $_SESSION['admin_logged_in'] = TRUE;
    $_SESSION['username'] = $admin_username;
    
    // TAMA NA ANG REDIRECTION: Ididirekta na sa Dashboard File (admindb.php)
    header("Location: admindb.php"); 
    exit();

} else {
    
    // LOGIN FAILED
    
    header("Location: login.html?error=failed"); 
    exit();
}
?>