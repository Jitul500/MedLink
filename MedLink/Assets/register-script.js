document.addEventListener('DOMContentLoaded', () => {
  const registrationForm = document.getElementById('patientRegistrationForm');

  if (registrationForm) {
    registrationForm.addEventListener('submit', (event) => {
      event.preventDefault();

      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      // 1. Password Match Validation
      if (password !== confirmPassword) {
        alert('Error: Passwords do not match. Please check and try again.');
        document.getElementById('password').focus();
        return;
      }

      // 2. Terms and Conditions Check (Handled by 'required' in HTML, but good to check)
      if (!document.getElementById('agreeTerms').checked) {
        alert('Error: You must agree to the Terms and Conditions.');
        return;
      }

      // If validation passes, proceed with data collection (e.g., sending to API)
      const formData = {
        fullName: document.getElementById('fullName').value,
        dob: document.getElementById('dob').value,
        gender: document.getElementById('gender').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        // Note: Never send plain password in a real app; hash it before submission.
      };

      console.log('Registration Data:', formData);
      alert('Registration Successful! Redirecting to login or verification page.');

      // In a real application, you would use fetch() or axios to POST this data.
      // window.location.href = 'login.html'; // Example redirect
    });
  }
});

// Function to toggle password visibility for a given field ID
function togglePasswordVisibility(fieldId) {
  const passwordField = document.getElementById(fieldId);
  // Determine which icon needs to be toggled based on the fieldId
  const toggleIcon = document.getElementById(fieldId === 'password' ? 'toggleIconPassword' : 'toggleIconConfirm');

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