<?php
// index.php - Main landing page for MedLink Smart Healthcare System
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MedLink - Smart Healthcare System</title>
  <link rel="stylesheet" href="Assets/style.css">
  
</head>

<body>

  <header class="navbar">
    <div class="container">
      <div class="logo">
        <a href="#">
          **MEDLINK**
          <span class="tagline">SMART HEALTHCARE SYSTEM</span>
        </a>
      </div>
      <nav class="nav-links">
        <a href="#">Home</a>
        <a href="#">Features</a>
        <a href="#">Solutions</a>
        <a href="#">About Us</a>
        <a href="#">Contact</a>
        <a href="Views/login.php" class="btn-login">Login/Sign-Up</a>
      </nav>
      <div class="menu-icon" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </header>

  <section class="hero-section">
    <div class="container">
      <div class="hero-content">
        <h1>Transforming Health. Connecting Care.</h1>
        <p>Seamless access to your health data, anytime, anywhere.</p>
        <div class="hero-buttons">
          <a href="#" class="btn-primary">Learn More</a>
          <a href="#" class="btn-secondary">Get Started</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="placeholder-hero.jpg" alt="A doctor consulting with a patient">
      </div>
    </div>
  </section>

  <section class="features-section">
    <div class="container">
      <h2>TESTIMONIALS & KEY FEATURES</h2>
      <div class="feature-grid">

        <div class="feature-card">
          <div class="icon-circle"><i class="fas fa-heartbeat"></i></div>
          <h3>PERSONALIZED HEALTH</h3>
          <p>Tailored health insights & preventative care plans.</p>
          <div class="testimonial">
            <img src="placeholder-user1.jpg" alt="User 1" class="user-avatar">
            <p>"Medlink changed how I manage health. So easy!"</p>
            <span class="user-name">- Sarah K.</span>
          </div>
        </div>

        <div class="feature-card">
          <div class="icon-circle"><i class="fas fa-shield-alt"></i></div>
          <h3>SECURE DATA</h3>
          <p>Your health information protected with advanced encryption.</p>
          <div class="testimonial">
            <img src="placeholder-user2.jpg" alt="User 2" class="user-avatar">
            <p>"Finally all my family's health records in one place."</p>
            <span class="user-name">- Mark</span>
          </div>
        </div>

        <div class="feature-card">
          <div class="icon-circle"><i class="fas fa-cloud"></i></div>
          <h3>REMOTE MONITORING</h3>
          <p>Connect with doctors & track & view from home.</p>
          <div class="testimonial">
            <img src="placeholder-user3.jpg" alt="User 3" class="user-avatar">
            <p>"My doctor always informed, thanks MedLink."</p>
            <span class="user-name">- Dr. Lee</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <footer>
    <div class="container footer-content">
      <div class="footer-logo">
        **MEDLINK**
        <span class="tagline">SMART HEALTHCARE SYSTEM</span>
      </div>
      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">FAQS</a>
      </div>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <p class="copyright">&copy; 2023 MEDLINK. All rights reserved.</p>
    </div>
  </footer>

  <script src="js/script.js"></script>
</body>

</html>