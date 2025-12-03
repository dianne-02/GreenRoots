<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us – GreenRoots</title>

    <link rel="stylesheet" href="style/styler.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;900&display=swap" rel="stylesheet">
</head>

<body class="contact-page">

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
            <a href="donate.php">Donate</a>
            <a href="contact.php" class="active">Contact Us</a>
        </nav>
    </div>
</header>

<main role="main">

    <section class="contact-hero" data-animate="fadeInUp">
        <h1>Get in Touch</h1>
        <p>Have questions or want to collaborate? Reach out to us— we'd love to hear from you!</p>
    </section>

    <section class="contact-section" data-animate="fadeIn">

        <div class="contact-info" data-animate="slideInLeft">
            <h2>Contact Information</h2>

            <p>
                <svg class="ci-icon" viewBox="0 0 24 24">
                    <path d="M4 4h16v16H4z"/>
                    <polyline points="4,4 12,13 20,4"/>
                </svg>
                info@greenroots.org
            </p>

            <p>
                <svg class="ci-icon" viewBox="0 0 24 24">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 3.16 9.81 19.79 19.79 0 0 1 .09 1.18 2 2 0 0 1 2.07 0h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L6 8a16 16 0 0 0 6 6l1.36-1.36A2 2 0 0 1 15.5 12a12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 20 14.5l2 2.42z"/>
                </svg>
                +63 912 345 6789
            </p>

            <p>
                <svg class="ci-icon" viewBox="0 0 24 24">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                123 Green Lane, Eco City, Philippines
            </p>

            <p>We’re here to help with inquiries about our projects, donations, or partnerships.</p>
        </div>

        <div class="contact-form" data-animate="slideInRight">
            <h2>Send a Message</h2>

            <form id="contactForm" action="save_message.php" method="POST">
                <label for="name">Full Name</label>
               <input type="text" id="name" name="name" required> 
               <label for="email">Email</label>
                <input type="email" id="email" name="email" required> 
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea> 
                <button type="submit">Send</button>
            </form>
        </div>

    </section>

    <section class="map-section" data-animate="fadeIn">
        <h2>Find Us</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15443.123456789!2d120.984218!3d14.599512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca035b97f3b%3A0x1234567890abcdef!2sManila%2C%20Metro%20Manila%2C%20Philippines!5e0!3m2!1sen!2sus!4v1234567890" loading="lazy" allowfullscreen></iframe>
    </section>

    <div class="back-home">
        <a href="index.html">← Back to Home</a>
    </div>

</main>

<div id="successPopup" class="popup hidden" role="dialog">
    <div class="popup-content">
        <p>Thank you for your message! We'll get back to you soon.</p>
        <button id="closePopup">Close</button>
    </div>
</div>

<footer class="fade-in">
    <div class="footer-content">

        <div class="footer-section">
            <h3>GreenRoots</h3>
            <p>A community-driven platform dedicated to restoring nature through tree planting and sustainable action. Connect with us to make a lasting impact, one tree at a time.</p>
        </div>

        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="donate.html">Donate</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2025 GreenRoots. All rights reserved. | Growing a Greener Tomorrow 🌿</p>
    </div>
</footer>

<script>
const form = document.getElementById("contactForm");
const popup = document.getElementById("successPopup");
const closeBtn = document.getElementById("closePopup");

// Define the input elements for validation
const nameInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const subjectInput = document.getElementById("subject");
const messageInput = document.getElementById("message");

form.addEventListener("submit", e => {
    e.preventDefault();

    // The validation check here will now use the correct IDs
    if (!nameInput.value || !emailInput.value || !subjectInput.value || !messageInput.value) {
        alert("Please fill in all required fields.");
        return;
    }

    // Since the inputs now have NAME attributes, FormData will correctly collect the data.
    let formData = new FormData(form);

    fetch("save_message.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result.trim() === "success") { // Use .trim() to handle potential whitespace
            popup.classList.remove("hidden");
            form.reset();
        } else {
            alert("Failed to send message. Response: " + result); // Added result for better debugging
        }
    });
});

// Close popup
closeBtn.addEventListener("click", () => {
    popup.classList.add("hidden");
});

// Fade animations
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.style.animationPlayState = "running";
    });
});

document.querySelectorAll("[data-animate]").forEach(el => observer.observe(el));
</script>

</body>
</html>