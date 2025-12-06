<?php
// FILE: donations.php

// Tiyakin na sinimulan ang session at naka-login ang admin (Kung gusto mo, idagdag ang logic dito)
// session_start();
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== TRUE) {
//     header("Location: login.html?status=unauthorized");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations | Green Roots</title>
    <link rel="stylesheet" href="donations-style.css">
</head>
<body>

    <header>
        <h1>🌿GreenRoots Admin Dashboard</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <main>
        <aside class="sidebar">
            <h2>Admin Menu</h2>
            <ul>
                <li><a href="admindb.php">Dashboard</a></li>
                <li><a href="#" class="active">Donations</a></li>
                <li><a href="messages.html">Messages</a></li>
            </ul>
        </aside>

        <section class="dashboard-content">
            <h2>Donations Overview</h2>
            <p>Track and manage donations that support tree planting and sustainable actions in our community.</p>

            <div class="cards">
                <div class="card">
                    <h3>Total Donations</h3>
                    <p id="totalDonationsCard">₱0</p>
                </div>
                <div class="card">
                    <h3>This Month</h3>
                    <p id="thisMonthDonationsCard">₱0</p>
                </div>
                <div class="card">
                    <h3>Top Donor</h3>
                    <p id="topDonorCard">N/A</p>
                </div>
            </div>

            <div class="donations-management">
                <h3>Recent Donations</h3>
                <a href="export_donations.php" class="export-btn">Export Report</a>
                <table class="donations-table">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="donationsTableBody">
                        </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Green Roots | Admin Panel</p>
    </footer>

    <script>
        const totalDonationsCard = document.getElementById('totalDonationsCard');
        const thisMonthDonationsCard = document.getElementById('thisMonthDonationsCard');
        const topDonorCard = document.getElementById('topDonorCard');
        const donationsTableBody = document.getElementById('donationsTableBody');

        async function fetchDonationsPageData() {
            try {
                // Fetch data from the PHP endpoint
                const response = await fetch('get_donation_data.php');
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    // Update Cards
                    totalDonationsCard.textContent = `₱${data.total_donations}`;
                    thisMonthDonationsCard.textContent = `₱${data.this_month_donations}`;
                    topDonorCard.textContent = data.top_donor;

                    // Update Table (Recent Donations)
                    donationsTableBody.innerHTML = ''; // Clear existing content
                    
                    if (data.recent_donations.length > 0) {
                        data.recent_donations.forEach(donation => {
                            const row = `
                                <tr>
                                    <td>${donation.donor_name}</td>
                                    <td>${donation.amount_formatted}</td>
                                    <td>${donation.formatted_date}</td>
                                    <td>${donation.status}</td>
                                    <td class="actions">
                                        <a href="#" class="view-btn">View</a>
                                        <a href="#" class="process-btn">Process</a>
                                    </td>
                                </tr>
                            `;
                            donationsTableBody.innerHTML += row;
                        });
                    } else {
                        donationsTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center;">No donations found.</td></tr>';
                    }

                } else {
                    console.error('Error fetching donations data:', data.error);
                    donationsTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: red;">Error loading data.</td></tr>';
                }
            } catch (error) {
                console.error('Fetch error:', error);
                donationsTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: red;">Connection error.</td></tr>';
            }
        }

        document.addEventListener('DOMContentLoaded', fetchDonationsPageData);
    </script>

</body>
</html>