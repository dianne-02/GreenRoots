<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donate – GreenRoots</title>
    <link rel="stylesheet" href="style/styler.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="donate-page">
    <header>
        <div class="container nav">
            <div class="brand">
                <div class="logo" aria-label="GreenRoots Logo"></div>
                <div>
                    <div class="title">GreenRoots</div>
                    <div class="tagline">Planting a Greener Future</div>
                </div>
            </div>
            <nav role="navigation">
                <a href="index.html">Home</a>
                <a href="about.html">About</a>
                <a href="services.html">Services</a>
                <a href="projects.html">Projects</a>
                <a href="./donate.php" class="active">Donate</a>
                <a href="./contact.php">Contact Us</a>
            </nav>
        </div>
    </header>

    <main role="main">
        <section class="donate-hero" data-animate="fadeInUp">
            <h1>Support Our Mission</h1>
            <p>Your donation helps us plant trees, restore ecosystems, and build a sustainable future for generations to come.</p>
        </section>

        <section class="donation-form-container" data-animate="fadeIn">
            <h1>Make a Donation</h1>
            <form id="donationForm" class="donation-form" action="save_donation.php" method="POST">
                
                <label for="donor_name">Full Name</label>
                <input type="text" id="donor_name" name="donor_name" required aria-describedby="name-help">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required aria-describedby="email-help">

                <label for="contact">Contact Number</label>
                <div class="contact-input-group">
                    <select id="country_code" name="country_code" required>
                        <option value="">Code</option>
                        <option value="+63" selected>🇵🇭 +63 (PH)</option>
                        <option value="+1">🇺🇸 +1 (US)</option>
                        <option value="+44">🇬🇧 +44 (UK)</option>
                        </select>
                    <input type="tel" id="contact" name="contact" required pattern="[0-9]+" title="Enter only digits" aria-describedby="contact-help">
                </div>

                <label for="amount">Donation Amount (₱)</label>
                <input type="number" id="amount" name="amount" min="1" step="0.01" required aria-describedby="amount-help">

                <button type="submit">Donate</button>
            </form>

            <?php
            // PHP logic to display status message after redirection from save_donation.php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success') {
                    echo '<p class="success-message" style="color: green; text-align: center;">Thank you for your generous donation!</p>';
                } elseif ($_GET['status'] == 'error') {
                    echo '<p class="error-message" style="color: red; text-align: center;">Failed to submit donation. Please try again.</p>';
                }
            }
            ?>
        </section>

        <section class="donation-info" data-animate="fadeIn">
            <div class="info-section" data-animate="slideInLeft">
                <h2>How Your Donation Helps</h2>
                <ul>
                    <li>₱100 plants one tree in local reforestation areas.</li>
                    <li>₱500 supports environmental education for students.</li>
                    <li>₱1000 maintains a community garden for a month.</li>
                </ul>
            </div>

            <div class="info-section" data-animate="slideInRight">
                <h2>Other Ways to Contribute</h2>
                <ul>
                    <li>Volunteer at our tree-planting events.</li>
                    <li>Sponsor a sapling drive in your community.</li>
                    <li>Share our advocacy on social media.</li>
                </ul>
            </div>
        </section>
    </main>

<footer class="fade-in">
  <div class="footer-content">
    <!-- Branding Section -->
    <div class="footer-section">
      <h3>GreenRoots</h3>
      <p>A community-driven platform dedicated to restoring nature through tree planting and sustainable action. Connect with us to make a lasting impact, one tree at a time.</p>
    </div>
    
    <!-- Quick Links Section -->
    <div class="footer-section">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="projects.html">Projects</a></li>
        <li><a href="donate.php">Donate</a></li>
        <li><a href="contact.html">Contact Us</a></li>
      </ul>
    </div>
    
    <!-- Social Media Section -->
    <div class="footer-section">
      <h4>Follow Us</h4>
      <div class="social-icons">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Gmail"><i class="fas fa-envelope"></i></a>
      </div>
    </div>
  </div>
  
  <!-- Bottom Copyright -->
  <div class="footer-bottom">
    <p>© 2025 GreenRoots. All rights reserved. | Growing a Greener Tomorrow 🌿</p>
  </div>
</footer>

<div id="successPopup" class="popup hidden">
    <div class="popup-content">
        <i class="fas fa-seedling" style="font-size: 3rem; color: #4CAF50; margin-bottom: 15px;"></i>
        <h2>Thank You, GreenRoots Supporter!</h2>
        <p>Your donation is processed! Thank you for helping us plant a greener future.</p>
        <button id="closePopup">Continue</button>
    </div>
</div>
<script src="jason.js"></script> 


    </body>
</html>