<?php
// FILE: db.php (CORRECTED)

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "greenroots_db"; // Tiyakin na ito ang tamang database name

// Gumamit ng mysqli_connect
$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// *** CRITICAL ADDITION: Ibalik ang connection object ***
return $conn;
?>