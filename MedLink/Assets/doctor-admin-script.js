document.addEventListener('DOMContentLoaded', () => {
  // Basic form submission handling (for demonstration)
  const loginForm = document.getElementById('providerLoginForm');

  if (loginForm) {
    loginForm.addEventListener('submit', (event) => {
      event.preventDefault();

      const id = document.getElementById('id').value;
      const password = document.getElementById('password').value;

      console.log('Provider Login attempt with:', { id, password });

      // Example success/error message (replace with actual backend logic)
      alert(`Provider Login Attempt Successful! (ID: ${id}) - Accessing Professional Dashboard.`);
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