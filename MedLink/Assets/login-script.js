document.addEventListener('DOMContentLoaded', () => {
  // Basic form submission handling (for demonstration)
  const loginForm = document.getElementById('patientLoginForm');

  if (loginForm) {
    loginForm.addEventListener('submit', (event) => {
      event.preventDefault();
      // In a real application, you would collect data and send it to a server

      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      console.log('Login attempt with:', { email, password });

      // Example success/error message (replace with actual backend logic)
      alert(`Login Attempt Successful! (ID: ${email}) - In a real app, you would be redirected.`);
    });
  }
});

// Function to toggle password visibility
function togglePasswordVisibility() {
  const passwordField = document.getElementById('password');
  const toggleIcon = document.getElementById('toggleIcon');

  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    toggleIcon.classList.remove('fa-eye');
    toggleIcon.classList.add('fa-eye-slash');
  } else {
    passwordField.type = 'password';
    toggleIcon.classList.remove('fa-eye-slash');
    toggleIcon.classList.add('fa-eye');
  }
}