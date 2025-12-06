<?php
// FILE: get_donation_data.php (FINAL VERSION based on your table structure)

header('Content-Type: application/json');

// Kuhanin ang database connection. Tiyakin na ang path ay tama!
$conn = require_once '../db.php';

$response = [
    'success' => false,
    'total_donations' => '0',
    'this_month_donations' => '0',
    'top_donor' => 'N/A',
    'recent_donations' => [],
    'error' => ''
];

try {
    // --- 1. Total Donations ---
    $sql_total = "SELECT SUM(amount) AS total FROM donations";
    $result_total = $conn->query($sql_total);
    if ($result_total && $row = $result_total->fetch_assoc()) {
        $response['total_donations'] = number_format($row['total'] ?? 0, 0); 
    }

    // --- 2. This Month's Donations (Using donation_date) ---
    $sql_month = "SELECT SUM(amount) AS monthly_total FROM donations 
                  WHERE MONTH(donation_date) = MONTH(CURDATE()) 
                  AND YEAR(donation_date) = YEAR(CURDATE())";
    $result_month = $conn->query($sql_month);
    if ($result_month && $row = $result_month->fetch_assoc()) {
        $response['this_month_donations'] = number_format($row['monthly_total'] ?? 0, 0);
    }

    // --- 3. Top Donor ---
    $sql_top_donor = "SELECT donor_name, SUM(amount) AS total_amount FROM donations 
                      GROUP BY donor_name ORDER BY total_amount DESC LIMIT 1";
    $result_top_donor = $conn->query($sql_top_donor);
    if ($result_top_donor && $row = $result_top_donor->fetch_assoc()) {
        $response['top_donor'] = $row['donor_name'] ?? 'N/A';
    }

    // --- 4. Recent Donations (REMOVED 'status' from SELECT) ---
    $sql_recent = "SELECT donor_name, amount, DATE_FORMAT(donation_date, '%Y-%m-%d') as formatted_date 
                   FROM donations 
                   ORDER BY donation_date DESC LIMIT 5";
    $result_recent = $conn->query($sql_recent);
    if ($result_recent) {
        while ($row = $result_recent->fetch_assoc()) {
            // Since status is missing, we hardcode it for display purposes
            $row['status'] = 'Processed'; 
            $row['amount_formatted'] = '₱' . number_format($row['amount'], 0); 
            $response['recent_donations'][] = $row;
        }
    }

    $response['success'] = true;

} catch (\Exception $e) {
    // This will catch PHP execution errors, not SQL query errors
    $response['error'] = 'PHP Execution Failed: ' . $e->getMessage();
}

$conn->close();

echo json_encode($response);