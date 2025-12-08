<?php
// FILE: donations.php

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
        <h1>GreenRoots Admin Dashboard</h1>
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
                
                <div id="loadingIndicator" style="text-align: center; padding: 20px;">Loading donations...</div>
                
                <table class="donations-table">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Amount</th>
                            <th>Date</th>
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

    <!-- Modal for viewing donation details -->
    <div id="donationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Donation Details</h2>
            <p><strong>Donor Name:</strong> <span id="modalDonorName"></span></p>
            <p><strong>Amount:</strong> <span id="modalAmount"></span></p>
            <p><strong>Date:</strong> <span id="modalDate"></span></p>
        </div>
    </div>

    <script>
        const totalDonationsCard = document.getElementById('totalDonationsCard');
        const thisMonthDonationsCard = document.getElementById('thisMonthDonationsCard');
        const topDonorCard = document.getElementById('topDonorCard');
        const donationsTableBody = document.getElementById('donationsTableBody');
        const loadingIndicator = document.getElementById('loadingIndicator'); // Kinuha ang loading indicator
        const donationsTable = document.querySelector('.donations-table'); // Kinuha ang table

        // Siguraduhin natin na naka-display ang loading indicator at naka-tago ang table sa simula
        loadingIndicator.style.display = 'block';
        donationsTable.style.display = 'none';

        async function fetchDonationsPageData() {
            try {
                // I-display ang loading indicator at itago ang table
                loadingIndicator.style.display = 'block';
                donationsTable.style.display = 'none';

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
                                    <td class="actions">
                                        <button class="view-btn" onclick="viewDonation(this)">View</button>
                                    </td>
                                </tr>
                            `;
                            donationsTableBody.innerHTML += row;
                        });
                        donationsTable.style.display = 'table'; // I-display ang table kung may data
                    } else {
                        donationsTableBody.innerHTML = '<tr><td colspan="4" style="text-align: center;">No donations found.</td></tr>';
                        donationsTable.style.display = 'table'; // I-display pa rin ang table para makita ang "No data" message
                    }

                } else {
                    console.error('Error fetching donations data:', data.error);
                    donationsTableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: red;">Error loading data.</td></tr>';
                    donationsTable.style.display = 'table';
                }
            } catch (error) {
                console.error('Fetch error:', error);
                donationsTableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: red;">Connection error.</td></tr>';
                donationsTable.style.display = 'table';
            } finally {
                loadingIndicator.style.display = 'none'; // Itago ang loading indicator pagkatapos ng fetch
            }
        }

        // Function to view donation details in modal
        function viewDonation(button) {
            const row = button.closest('tr');
            const cells = row.querySelectorAll('td');
            document.getElementById('modalDonorName').textContent = cells[0].textContent;
            document.getElementById('modalAmount').textContent = cells[1].textContent;
            document.getElementById('modalDate').textContent = cells[2].textContent;
            document.getElementById('donationModal').style.display = 'block';
        }

        // Close modal when clicking the close button
        document.querySelector('.close').onclick = function() {
            document.getElementById('donationModal').style.display = 'none';
        };

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('donationModal')) {
                document.getElementById('donationModal').style.display = 'none';
            }
        };

        document.addEventListener('DOMContentLoaded', fetchDonationsPageData);
    </script>

</body>
</html>
