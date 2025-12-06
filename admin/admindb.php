<?php
// FILE: admindb.php (Ang iyong Dashboard)

// Tiyakin na sinimulan ang session
session_start();

// I-check kung naka-login ang user
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== TRUE) {
    // Kung HINDI naka-login, idirekta pabalik sa login page
    header("Location: login.html?status=unauthorized");
    exit();
}
// Kung naka-login, ipagpatuloy ang pag-display ng HTML sa ibaba
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Green Roots</title>
    <link rel="stylesheet" href="admindb-style.css">
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
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="donations.php">Donations</a></li>
                <li><a href="messages.html">Messages</a></li>
            </ul>
        </aside>

        <section class="dashboard-content">
            <h2>Welcome, Admin</h2>
            <p>Here’s an overview of the Green Roots community progress.</p>

            <div class="cards">
                <div class="card">
                    <h3>Total Donations</h3>
                    <p id="dashboardTotalDonations">₱0</p>
                </div>
                <div class="card">
                    <h3>Messages Received</h3>
                    <p id="dashboardMessagesCount">0</p> 
                </div>
            </div>

            <div class="activity">
                <h3>Recent Activities</h3>
                <ul id="recentActivityList">
                    <li id="recentMessageActivity">0 new messages received</li> 
                    <li id="recentDonationActivity">No recent donations</li>        
                </ul>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Green Roots | Admin Panel</p>
    </footer>

    <script>
        // Element IDs para sa Dashboard
        const dashboardCountEl = document.getElementById('dashboardMessagesCount');
        const recentMessageActivityEl = document.getElementById('recentMessageActivity');

        // *** CORRECTION: Idinagdag ang missing variables ***
        const dashboardTotalDonationsEl = document.getElementById('dashboardTotalDonations');
        const recentActivityListEl = document.getElementById('recentActivityList');
        // ************************************************

        // Function para kunin at i-update ang message counts
        async function fetchDashboardCounts() {
            try {
                // Tiyakin na ang path ay tama (script ay nasa parehong 'admin/' folder)
                const response = await fetch('get_message_counts.php');
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    // Ang data.total ay magiging '0' kung walang laman ang database (na tama)
                    dashboardCountEl.textContent = data.total;
                    
                    // I-update ang recent activity
                    recentMessageActivityEl.textContent = `${data.unread} new messages received`;
                    recentMessageActivityEl.style.fontWeight = data.unread > 0 ? 'bold' : 'normal';

                } else {
                    // Kung may error sa PHP, gawing '0' ang display
                    dashboardCountEl.textContent = '0'; 
                    recentMessageActivityEl.textContent = '0 new messages received';
                    console.error('Error fetching dashboard counts:', data.error);
                }
            } catch (error) {
                // Kung may connection error, gawing '0' ang display
                console.error('Fetch counts error:', error);
                dashboardCountEl.textContent = '0'; 
                recentMessageActivityEl.textContent = '0 new messages received';
            }
        }
        
        // BAGONG FUNCTION: Para sa Donation Data
        async function fetchDonationData() {
            try {
                const response = await fetch('get_donation_data.php');
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    // Update Total Donations
                    // Gagamit na ngayon ng defined variable: dashboardTotalDonationsEl
                    dashboardTotalDonationsEl.textContent = `₱${data.total_donations}`;
                    
                    // Update Recent Activities (Mag-pop up lang ang pinaka-recent)
                    if (data.recent_donations.length > 0) {
                        const mostRecent = data.recent_donations[0];
                        
                        const existingActivity = document.getElementById('recentDonationActivity');
                        if (existingActivity) {
                            existingActivity.textContent = `₱${mostRecent.amount_formatted.replace('₱', '')} donation from "${mostRecent.donor_name}"`;
                            existingActivity.style.fontWeight = 'bold'; // I-bold para mapansin
                        }

                    } else {
                        // Kung walang donation, ibalik sa default
                        const existingActivity = document.getElementById('recentDonationActivity');
                        if (existingActivity) {
                            existingActivity.textContent = 'No recent donations';
                            existingActivity.style.fontWeight = 'normal';
                        }
                    }

                } else {
                    console.error('Error fetching donation data:', data.error);
                    // Set default value if data fetching fails
                    dashboardTotalDonationsEl.textContent = '₱0';
                }
            } catch (error) {
                console.error('Fetch donations error:', error);
                // Set default value if fetch connection fails
                dashboardTotalDonationsEl.textContent = '₱0';
            }
        }
        
       // I-run ang parehong functions sa DOM load
        document.addEventListener('DOMContentLoaded', () => {
            fetchDashboardCounts();
            fetchDonationData(); 
        });
    </script>
</body>
</html>