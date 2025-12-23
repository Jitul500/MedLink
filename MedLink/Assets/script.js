document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.getElementById('menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  // Function to toggle the mobile navigation menu
  menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');

    // Optional: Change the icon (bars to times/close)
    const icon = menuToggle.querySelector('i');
    if (navLinks.classList.contains('active')) {
      icon.classList.remove('fa-bars');
      icon.classList.add('fa-times');
    } else {
      icon.classList.remove('fa-times');
      icon.classList.add('fa-bars');
    }
  });

  // Optional: Close the menu when a link is clicked (useful for single-page sites)
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      if (navLinks.classList.contains('active')) {
        navLinks.classList.remove('active');
        menuToggle.querySelector('i').classList.remove('fa-times');
        menuToggle.querySelector('i').classList.add('fa-bars');
      }
    });
  });
});

// You can add more JavaScript here for features like:
// 1. Form validation (if you add a contact form)
// 2. Carousel/Slider for testimonials (if you add more)
// 3. Scroll effects (e.g., changing the header on scroll)