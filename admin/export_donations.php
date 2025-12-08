<?php
// FILE: export_donations.php 

$conn = require_once '../db.php'; 

if ($conn->connect_error) {
    die("Database connection failed for export.");
}

$filename = "greenroots_donations_" . date('Ymd') . ".csv";
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

// I-set ang CSV header row, using 'Contact' and 'Date' for readability
fputcsv($output, array('ID', 'Donor Name', 'Email', 'Contact', 'Amount', 'Date Donated', 'Status')); 

// KUHAON ang lahat ng donations (REMOVED 'status' from SELECT)
$sql = "SELECT id, donor_name, email, contact, amount, donation_date FROM donations ORDER BY donation_date DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add a hardcoded 'Processed' status for the CSV output
        $row['status'] = 'Processed'; 
        
        $row['amount'] = number_format($row['amount'], 2, '.', '');
        
        // Re-order columns to match the header row
        $csv_row = [
            $row['id'], 
            $row['donor_name'], 
            $row['email'], 
            $row['contact'], 
            $row['amount'], 
            $row['donation_date'],
            $row['status'] // Using the hardcoded 'Processed' value
        ];
        
        fputcsv($output, $csv_row);
    }
}

fclose($output);
$conn->close();
exit();
?>